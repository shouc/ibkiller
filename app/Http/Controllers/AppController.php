<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Hash;
use App\Mail\AuthEmail;
use Mail;

class AppController extends Controller
{
    public function sessionVal($session)
    {
        return DB::table('app_users')
            ->where('session' , $session)
            ->get();
    }

    public function getQuestionNum($paper)
    {
        return count(DB::table('questions')
            ->where('paper' , $paper)
            ->get());
    }

    public function checkEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return true;
    }

    public function sendAuthEmail($authSession, $mailAddr)
    {
        Mail::to($mailAddr)->send(new AuthEmail($authSession, 'Confirm Your Email!'));
    }

    public function sendAuthEmailWithSession($session)
    {
        $userInfo = $this->sessionVal($session)
            ->first();
        $this->sendAuthEmail($userInfo->auth_session, $userInfo->email);
    }

    public function addUnreadMessageLocalAPI($_session, $_to, $_context){
        $_user = $this->sessionVal($_session)->first();
        DB::table('message')
            ->insert([
                'from' => $_session,
                'from_name' => $_user->name,
                'to' => $_to,
                'read' => 0,
                'context' => base64_encode($_context),
                'time' => time()
            ]);
        return ["success" => true, 
            "info" => ''
        ];             
    }

    public function checkPassword($password)
    {
        if (strlen($password) < 8) {
            return false;
        }
        if (!preg_match("#[0-9]+#", $password)) {
            return false;
        }
        if (!preg_match("#[a-zA-Z]+#", $password)) {
            return false;
        }
        return true;
    }

    public function version(Request $request)
    {
        return "3.0.0 (Laravel)";
    }

    public function getPapersAPI(Request $request)
    {
        if ($request->has(['Cat','Session'])) {
            $_cat = $request->Cat;
            $_session = $request->Session;
            $allCat = DB::table('groups')
                ->where('cat', $_cat)
                ->get();
            $paperStatus = DB::table('app_records')
                ->where('session', $_session)
                ->select('paper')
                ->get()
                ->pluck('paper')
                ->toArray();
            $allCatRes = array();
            foreach ($allCat as $i) {
                $allPaperInGID = DB::table('papers')
                    ->where('group_id', $i->group_id)
                    ->get();
                $allPaperTemp = array();
                foreach ($allPaperInGID as $j) {
                    if ($j->condition == 1){
                        if (in_array($j->paper, $paperStatus)){
                            array_push($allPaperTemp, [$j->paper,$j->totalQuestionNum,0,true, $j->_type]);
                                
                        } else {
                            array_push($allPaperTemp, [$j->paper,$j->totalQuestionNum,0,false, $j->_type]);
                        }
                    } else {
                        array_push($allPaperTemp, [$j->paper,$j->totalQuestionNum,1,false, 0]);
                    }
        }
                array_push($allCatRes, [
                        'catName' => $i->group_name,
                        'paper' => $allPaperTemp,
                    ]);
            }
            return ["result" => $allCatRes];
        }
        return ["result" => "-100"];
    }

    public function getPapers(Request $request)
    {
        return response()->json($this->getPapersAPI($request));
    }

    public function getDetailOfPaperAPI(Request $request)
    {
        if ($request->has(['Paper'])) {
            $_paper = $request->Paper;
            $allQuestionTemp = array();
            $allQuestion = DB::table('questions')
                ->where('paper', $_paper)
                ->get();
            foreach ($allQuestion as $key=>$i) {
                $questionLine = [
                    "questionNum" => $key + 1, 
                    "content" => base64_encode($i->question),
                    "answer" => base64_encode($i->answer), 
                    "type" => $i->type];
                array_push($allQuestionTemp, $questionLine);
            }
            return ["result" => $allQuestionTemp];
        }
        return ["result" => "-100"];
    }

    public function getDetailOfPaper(Request $request)
    {
        return response()->json($this->getDetailOfPaperAPI($request));
    }

    public function commitAnswerAPI(Request $request)
    {
        if ($request->has(['Paper', 'Answer', 'PID', 'Session'])) {
            $_paper = urldecode($request->Paper);
            $_answer = json_decode($request->Answer);
            $_pid = $request->PID;
            $_session = $request->Session;
            if ($this->sessionVal($_session) == "[]"){
                $_session = 'Anonymous$k$';
            }
            foreach ($_answer->answer as $key => $i) {
                DB::table('app_records')->insert(
                    [
                        'paper' => $_paper, 
                        'qnum' => $i[0],
                        'answer' => $i[1],
                        'correct' => $i[2],
                        'pid' => $_pid,
                        'session' => $_session,
                        'time' => time(),
                    ]);
            };
            return ["result" => "1"];
        }
        return ["result" => "-100"];
    }

    public function commitAnswer(Request $request)
    {
        return response()->json($this->commitAnswerAPI($request));
    }

    public function getDetailOfPIDAPI(Request $request)
    {
        if ($request->has(['PID'])) {
            $_pid = $request->PID;
            $pidInfo = DB::table('app_records')
                ->where('pid', $_pid)
                ->get()
                ->toArray();

            if ($pidInfo){
                $questionDetail = DB::table('questions')
                    ->where('paper', $pidInfo[0]->paper)
                    ->get()
                    ->toArray();
                $allDataTemp = array();
                $score = 0;
                foreach (array_map(null,$pidInfo,$questionDetail) as $i) {
                    array_push($allDataTemp, [
                        'questionNum' => $i[0]->qnum,
                        'content' => base64_encode($i[1]->question),
                        'answer' => base64_encode($i[1]->answer),
                        'type' => $i[1]->type,
                        'correct' => $i[0]->correct,
                        'userAnswer' => $i[0]->answer,
                    ]);
                    $score += $i[0]->correct;
                }
                return ["result" => ["score" => $score, 
                    "info" => $allDataTemp,
                    "paper" => $pidInfo[0]->paper]];
            }
        }
        return ["result" => "-100"];
    }

    public function getDetailOfPID(Request $request)
    {
        return response()->json($this->getDetailOfPIDAPI($request));
    }

    public function getUserPIDAPI(Request $request)
    {
        if ($request->has(['Session','Range','Amount'])) {
            $_session = $request->Session;
            $_range = (int)$request->Range;
            $_amount = (int)$request->Amount;
            $allPID = DB::table('app_records')
                ->orderBy('id', 'desc')
                ->where('session', $_session)
                ->get();
            $userPID = array();
            $userPIDNum = array();
            $allDataTemp = array();
            $allDataTempRes = array();
            foreach ($allPID as $key=>$i) {
                if (!in_array($i->pid, $userPID)){
                    array_push($userPID, $i->pid);
                    array_push($userPIDNum, $key);
                }
            }
            foreach (array_map(null,$userPIDNum,$userPID) as $j) {
                $onePID = array();
                foreach ($allPID as $key => $m) {
                    if ($m->pid == $j[1]){
                        array_push($onePID, $m);
                    }
                }
                $score = 0;
                $totalQuestionNum = 0;
                foreach ($onePID as $k) {
                    $score += (int) $k->correct;
                    $totalQuestionNum += 1;
                }
                array_push($allDataTemp, [
                    'time' => $onePID[0]->time,
                    'score' => $score,
                    'pid' => $onePID[0]->pid,
                    'totalQuestionNum' => $totalQuestionNum,
                    'paperName' => $onePID[0]->paper,
                ]);
            }
            $pageNum = (int) (count($allDataTemp) / $_amount - 0.000000000001) + 1;
            foreach ($allDataTemp as $key => $i) {
                if (in_array($key, range(($_range-1)*$_amount, $_range*$_amount - 1)))
                {
                    array_push($allDataTempRes, $i);
                }
            }
            if (count($allDataTempRes)){
                return ["result" => $allDataTempRes, "isExist" => true, 'pageNum' => $pageNum];
            } else {
                return ["result" => $allDataTempRes, "isExist" => false, 'pageNum' => $pageNum];
            }
        }
    }

    public function getUserPID(Request $request)
    {
        return response()->json($this->getUserPIDAPI($request));
    }

    public function loginAPI(Request $request)
    {
        if ($request->has(['Email','Password'])) {
            $_email = $request->Email;
            $_password = $request->Password;
            $userInfo = DB::table('app_users')
                ->where('email', $_email)
                ->first();
            if ($userInfo){
                if (Hash::check($_password, $userInfo->password)){
                    return ["success" => true, 
                        "session" => $userInfo->session,
                        "info" => $userInfo->name
                    ];
                }
                return ["success" => false, 
                        "session" => '',
                        "info" => "Wrong Password"
                    ];
            }
            return ["success" => false, 
                    "session" => '',
                    "info" => "No Such User"
                ];
        }
    }

    public function login(Request $request)
    {
        return response()->json($this->loginAPI($request));
    }

    public function registerAPI(Request $request)
    {
        if ($request->has(['Email','Password','Name'])) {
            $_email = $request->Email;
            $_password = $request->Password;
            $_name = $request->Name;
            if (!$this->checkEmail($_email)){
                return ["success" => false, 
                        "session" => '',
                        "info" => "Not an Email"
                    ];
            }
            if (!$this->checkPassword($_password)){
                return ["success" => false, 
                        "session" => '',
                        "info" => "Password Too Weak"
                    ];
            }
            $userInfo = DB::table('app_users')
                ->where('email', $_email)
                ->first();
            if ($userInfo){
                return ["success" => false, 
                        "session" => '',
                        "info" => "Email Registered"
                    ];
            }
            $nameInfo = DB::table('app_users')
                ->where('name', $_name)
                ->first();
            if ($nameInfo){
                return ["success" => false, 
                        "session" => '',
                        "info" => "Username Registered"
                    ];
            }
            $salt = "EncryptSessionSalt";
            $_session = Hash::make($_email . $_password . $salt . time());
            $authSession = Hash::make($_session . (String)time() . $salt);
            DB::table('app_users')->insert(
                [
                    'name' => $_name,
                    'email' => $_email,
                    'password' => Hash::make($_password),
                    'session' => $_session,
                    'auth_session' => $authSession,
                    'is_auth' => 0
                ]
            );
            $this->addUnreadMessageLocalAPI('$2y$10$1jAy7xe4qnXcbW6DmBkc4e1gQ9El6HS83id77xYzE0yj2qfnxLYOK', $_name, 'Thanks for registering! You could find a confirmation link in your Email.');
            $this->sendAuthEmail($authSession, $_email);
            return ["success" => true, 
                    "session" => $_session,
                    "info" => ''
                ];
        }
    }

    public function register(Request $request)
    {
        return response()->json($this->registerAPI($request));
    }

    public function confirmAPI(Request $request)
    {
        if ($request->has(['s'])) {
            $_authSession = $request->s;
            $userInfo = DB::table('app_users')
                ->where('auth_session', $_authSession)
                ->first();
            if ($userInfo == ""){
                return ["success" => false, 
                        "info" => 'Wrong auth session'
                ];
            }
            DB::table('app_users')
                ->where('auth_session', $_authSession)
                ->update(['is_auth' => 1]);
            return ["success" => true, 
                    "info" => ''
                ];
        }
    }

    public function confirm(Request $request)
    {
        return response()->json($this->confirmAPI($request));
    }

    public function addFavoriteAPI(Request $request)
    {
        if ($request->has(['Name','Session'])) {
            $_name = $request->Name;
            $_session = $request->Session;
            if ($this->sessionVal($_session) == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            $userInfo = DB::table('favorite')
                ->where('session', $_session)
                ->select('name')
                ->get()
                ->pluck('name')
                ->toArray();
            if (in_array($_name, $userInfo)){
                return ["success" => false, 
                    "info" => 'Already Exist'
                ];
            } else {
                $subjectInfo = DB::table('subjects')
                    ->where('name', $_name)
                    ->get();
                if (count($subjectInfo)){
                    DB::table('favorite')->insert([
                        'session' => $_session, 
                        'name' => $_name,
                        'img' => $subjectInfo->first()->img,
                        'ibg' => $subjectInfo->first()->ibg,
                    ]);
                    return ["success" => true, 
                        "info" => ''
                    ];
                } else {
                    return ["success" => false, 
                        "info" => 'Unexpected Subject'
                    ];
                }
                
            }
        }
    }

    public function addFavorite(Request $request)
    {
        return response()->json($this->addFavoriteAPI($request));
    }

    public function delFavoriteAPI(Request $request)
    {
        if ($request->has(['Name','Session'])) {
            $_name = $request->Name;
            $_session = $request->Session;
            if ($this->sessionVal($_session) == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            DB::table('favorite')
                ->where([
                    ['name', $_name],
                    ['session', $_session],
                ])
                ->delete();
            return ["success" => true, 
                "info" => ''
            ];
        }
    }

    public function delFavorite(Request $request)
    {
        return response()->json($this->delFavoriteAPI($request));
    }

    public function addDiscussionAPI(Request $request){
        //http://127.0.0.1:8000/api/addDiscussion?Session= $2y$10$gImwLd7IqZkRHY2tfKlnceAQ2OlrAjN8cngxmL/cFUdmkApp2rlxe&Paper=1&Question=1&Context=1
        if ($request->has(['Session', 'Context', 'Paper', 'Question'])) {
            $_session = $request->Session;
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            $_name = $_user->name;
            $_time = time();
            $_context = $request->Context;
            $_paper = $request->Paper;
            $_question = $request->Question;
            if(strpos($_context, '@') == false){
                $atName = strstr($_context, '@');
                $atName = strstr($atName, ' ', True);
                $atName = str_replace('@', '', $atName);
                $this->addUnreadMessageLocalAPI($_session, $atName, 
                    '<p class="msg-head">Your comment <a href="/question?Paper=' . base64_encode($_paper) . '">here</a> has been replied.</p>Wala! User <strong>' . $_name . '</strong> replied your comment with following content: <p class="replies">' . $_context . '</p>'
                );
            }
            DB::table('discussion')
                ->insert([
                    'name' => $_name,
                    'context' => $_context,
                    'time' => $_time,
                    'like'=> 0,
                    'paper' => $_paper,
                    'question' => $_question,
                    'session' => $_session,
                ]);
            return ["success" => true, 
                "info" => ''
            ];
        }
    }

    public function addDiscussion(Request $request){
        return response()->json($this->addDiscussionAPI($request));
    }

    public function delDiscussionAPI(Request $request){
        if ($request->has(['Session', 'ID'])) {
            $_session = $request->Session;
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            $_id = $request->ID;
            $result = DB::table('discussion')
                ->where([
                    ['session', $_session],
                    ['id', $_id]
                ])
                ->get();
            if ($result != "[]"){
                DB::table('discussion')
                ->where([
                    ['session', $_session],
                    ['id', $_id]
                ])
                ->delete();
                return ["success" => true, 
                    "info" => ''
                ]; 
            }
            return ["success" => false, 
                "info" => 'Not belongs to you!'
            ];
        }
    }

    public function delDiscussion(Request $request){
        return response()->json($this->delDiscussionAPI($request));
    }

    public function likeDiscussionAPI(Request $request){
        if ($request->has(['Session', 'ID'])) {
            $_session = $request->Session;
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            $_id = $request->ID;
            $_time = time();
            $discussion = DB::table('discussion')
                ->where([
                    ['session', $_session],
                    ['id', $_id]
                ])
                ->get();
            $likes = DB::table('likes')
                ->where([
                    ['session', $_session],
                    ['discussion_id', $_id]
                ])
                ->get();
            if ($discussion != "[]"){
                return ["success" => false, 
                    "info" => 'Do not like yourself!'
                ];
            }
            if ($likes != "[]"){
                return ["success" => false, 
                    "info" => 'Do not repeat!'
                ];
            }
            DB::table('discussion')
                ->where([
                    ['id', $_id]
                ])
                ->increment('like');
            DB::table('likes')
                ->insert([
                    'session' => $_session,
                    'discussion_id' => $_id,
                    'time' => $_time
                ]);
            return ["success" => true, 
                "info" => ''
            ];             
        }
    }

    public function likeDiscussion(Request $request){
        return response()->json($this->likeDiscussionAPI($request));
    }

    public function unlikeDiscussionAPI(Request $request){
        if ($request->has(['Session', 'ID'])) {
            $_session = $request->Session;
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            $_id = $request->ID;
            $likes = DB::table('likes')
                ->where([
                    ['session', $_session],
                    ['discussion_id', $_id]
                ])
                ->get();
            if ($likes == "[]"){
                return ["success" => false, 
                    "info" => 'No record'
                ]; 
            }
            DB::table('likes')
                ->where([
                    ['session', $_session],
                    ['discussion_id', $_id]
                ])
                ->delete();
            DB::table('discussion')
                ->where([
                    ['id', $_id],
                ])
                ->decrement('like');
            return ["success" => true, 
                "info" => ''
            ];
        }
    }

    public function unlikeDiscussion(Request $request){
        return response()->json($this->unlikeDiscussionAPI($request));
    }

    public function showDiscussionAPI(Request $request){
        if ($request->has(['Session', 'Paper', 'Question', 'Amount', 'Range'])) {
            $_amount = $request->Amount;
            $_range = $request->Range;
            $_question = $request->Question;
            $_paper = $request->Paper;
            $_session = $request->Session;
            $discussion = array_reverse(DB::table('discussion')
                ->where([
                    ['paper', $_paper],
                    ['question', $_question]
                ])
                ->get()
                ->toArray()
            );
            $likes = DB::table('likes')
                ->where([
                    ['session', $_session],
                ])
                ->get();
            $allDataTempRes = [];
            foreach ($discussion as $key => $i) {
                if (in_array($key, range(($_range-1)*$_amount, $_range*$_amount - 1)))
                {
                    if ($i->session == $_session){
                        $i->isMine = true;
                    } else {
                        $i->isMine = false;
                    }
                    $i->isLiked = false;
                    foreach ($likes as $like) {
                        if ($like->discussion_id == $i->id){
                            $i->isLiked = true;
                        }
                    }
                    unset($i->session);
                    array_push($allDataTempRes, $i);
                }
            }
            return ["success" => true, 
                    "info" => $allDataTempRes,
                    "pageNum" => (int) (count($discussion) / $_amount - 0.000000000001) + 1
            ];
        }
    }

    public function showDiscussion(Request $request){
        return response()->json($this->showDiscussionAPI($request));
    }

    public function addUnreadMessageAPI(Request $request){
        if ($request->has(['Session', 'To', 'Context'])) {
            $_session = $request->Session;
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            $_to = $request->To;
            $_context = $request->Context;
            DB::table('message')
                ->insert([
                    'from' => $_session,
                    'from_name' => $_user->name,
                    'to' => $_to,
                    'read' => 0,
                    'context' => base64_encode($_context),
                    'time' => time()
                ]);
            return ["success" => true, 
                "info" => ''
            ];             
        }
    }

    public function addUnreadMessage(Request $request){
        return response()->json($this->addUnreadMessageAPI($request));
    }

    public function showMessageAPI(Request $request){
        if ($request->has(['Session', 'Amount', 'Range'])) {
            $_session = $request->Session;
            $_amount = $request->Amount;
            $_range = $request->Range;
            $allDataTempRes = [];
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            $messages = array_reverse(DB::table('message')
                ->where('to', $_user->name)
                ->get()
                ->toArray()
            );
            $pageNum = (int) (count($messages) / $_amount - 0.000000000001) + 1;
            foreach ($messages as $key => $i) {
                if (in_array($key, range(($_range-1)*$_amount, $_range*$_amount - 1)))
                    {
                        unset($i->from);
                        array_push($allDataTempRes, $i);
                    }
                }
                return ["success" => true, 
                    "info" => $allDataTempRes,
                    "pageNum" => $pageNum
                ];
        }
    }

    public function showMessage(Request $request){
        return response()->json($this->showMessageAPI($request));
    }

    public function readMessageAPI(Request $request){
        if ($request->has(['Session', 'ID'])) {
            $_session = $request->Session;
            $_id = $request->ID;
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            $result = DB::table('discussion')
                ->where([['id', $_id], ['to', $_session]])
                ->get();
            if ($result == "[]"){
                return ["success" => false, 
                        "info" => 'No comment'];
            }
            DB::table('message')
                ->where([['id', $_id], ['to', $_session]])
                ->update(['read' => 1]);
            return ["success" => true, 
                    "info" => ''];
        }
    }
    public function readMessage(Request $request){
        return response()->json($this->readMessageAPI($request));
    }

    public function readAllMessageAPI(Request $request){
        if ($request->has(['Session'])) {
            $_session = $request->Session;
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }
            DB::table('message')
                ->where('to', $_user->name)
                ->update(['read' => 1]);
            return ["success" => true, 
                    "info" => ''];
        }
    }
    public function readAllMessage(Request $request){
        return response()->json($this->readAllMessageAPI($request));
    }

    public function countUnreadMessageAPI(Request $request){
        if ($request->has(['Session'])) {
            $_session = $request->Session;
            $_user = $this->sessionVal($_session)->first();
            if ($_user == "[]"){
                return ["success" => false, 
                    "info" => 'Invalid Session'
                ];
            }

            $result = DB::table('message')
                ->where([['to', $_user->name], ['read', '0']])
                ->get();
            
            return ["success" => true, 
                    "info" => count($result)
                ];
        }
    }
    public function countUnreadMessage(Request $request){
        return response()->json($this->countUnreadMessageAPI($request));
    }
}
