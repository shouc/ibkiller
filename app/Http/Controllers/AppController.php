<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Hash;
class AppController extends Controller
{
    public function sessionVal($session)
    {
        return DB::table('app_users')
            ->where('session' , $session)
            ->get();
    }

    public function checkEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        return true;
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

    public function getPapers(Request $request)
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
            return response()->json(["result" => $allCatRes]);
        }
        return response()->json(["result" => "-100"]);
    }

    public function getDetailOfPaper(Request $request)
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
            return response()->json(["result" => $allQuestionTemp]);
        }
        return response()->json(["result" => "-100"]);
    }

    public function commitAnswer(Request $request)
    {
        if ($request->has(['Paper', 'Answer', 'PID', 'Session'])) {
            $_paper = $request->Paper;
            $_answer = json_decode($request->Answer);
            $_pid = $request->PID;
            $_session = $request->Session;
            if ($this->sessionVal($_session) == "[]"){
                return response()->json(["result" => "0"]);
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
            return response()->json(["result" => "1"]);
        }
        return response()->json(["result" => "-100"]);
    }

    public function getDetailOfPID(Request $request)
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
                return response()->json(["result" => ["score" => $score, 
                    "info" => $allDataTemp]]);
            }
        }
    }

    public function getUserPID(Request $request)
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
                    $score += (int)$k->correct;
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
            foreach ($allDataTemp as $key => $i) {
                if (in_array($key, range(($_range-1)*$_amount, $_range*$_amount - 1)))
                {
                    array_push($allDataTempRes, $i);
                }
            }
            return response()->json(["result" => $allDataTempRes]);
        }
    }

    public function login(Request $request)
    {
        if ($request->has(['Email','Password'])) {
            $_email = $request->Email;
            $_password = $request->Password;
            $userInfo = DB::table('app_users')
                ->where('email', $_email)
                ->first();
            if ($userInfo){
                if (Hash::check($_password, $userInfo->password)){
                    return response()->json(["success" => true, 
                        "session" => $userInfo->session,
                        "info" => ""
                    ]);
                }
                return response()->json(["success" => false, 
                        "session" => '',
                        "info" => "Wrong Password"
                    ]);
            }
            return response()->json(["success" => false, 
                    "session" => '',
                    "info" => "No Such User"
                ]);
        }
    }

    public function register(Request $request)
    {
        if ($request->has(['Email','Password'])) {
            $_email = $request->Email;
            $_password = $request->Password;
            if (!$this->checkEmail($_email)){
                return response()->json(["success" => false, 
                        "session" => '',
                        "info" => "Not an Email"
                    ]);
            }
            if (!$this->checkPassword($_password)){
                return response()->json(["success" => false, 
                        "session" => '',
                        "info" => "Password Too Weak"
                    ]);
            }
            $userInfo = DB::table('app_users')
                ->where('email', $_email)
                ->first();
            if ($userInfo){
                return response()->json(["success" => false, 
                        "session" => '',
                        "info" => "Email Registered"
                    ]);
            }
            $salt = "EncryptSessionSalt";
            $_session = Hash::make($_email . $_password . $salt . time());
            DB::table('app_users')->insert(
                    [
                        'email' => $_email, 
                        'password' => Hash::make($_password),
                        'session' => $_session
                    ]);
            return response()->json(["success" => true, 
                    "session" => $_session,
                    "info" => ''
                ]);

        }
    }
}
