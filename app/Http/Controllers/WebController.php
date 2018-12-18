<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Hash;
use Cookie;
use App\Http\Controllers\AppController;
class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function init()
    {
        return new AppController();
    }

    public function favorite($favorites, $subject){
        foreach ($favorites as $l=>&$favorite) {
            if ($favorite->name == $subject->name){
                return 1;
            }
        }
        return 0;
    }

    public function home(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
        $subjects = DB::table('subjects')
            ->get();
        $favorites = DB::table('favorite')
            ->where('session', $_session)
            ->get();
        $ibgs = [];
        $results = [];
        $final = [];
        foreach ($subjects as $k=>&$value) {
            if (!in_array($value->ibg, $ibgs)){
                array_push($ibgs, $value->ibg);
            }
            $arr = [
                'name' => $value->name,
                'picture' => env('APP_URL') . '/app/icon/' . $value->img,
                'favorite' => $this->favorite($favorites, $value),
            ];
            array_push($results, [
                'ibg' => $value->ibg,
                'data' => $arr,
            ]);
        }
        foreach ($favorites as $k=>&$favorite) {
            if (!in_array('Your Favorite', $ibgs)){
                array_push($ibgs, 'Your Favorite');
            }
            $arr = [
                'name' => $favorite->name,
                'picture' => env('APP_URL') . '/app/icon/' . $favorite->img,
                'favorite' => 1,
            ];
            array_push($results, [
                'ibg' => 'Your Favorite',
                'data' => $arr,
            ]);
        }
        unset($value);
        foreach ($ibgs as $k=>&$value) {
            $temp = [];
            foreach ($results as $i=>&$result) {
                if ($result["ibg"] == $value){
                    array_push($temp, $result["data"]);
                }
            }
            array_push($final, [
                'name' => $value,
                'css' => 'g' . $k,
                'data' => $temp,
            ]);
            unset($temp);
        }
        return view('app', ['server' => env('APP_URL'), 
            'data' => base64_encode(json_encode($final)),
            'isLoggedIn' => $isLoggedIn,
        ]);
    }

    public function category(Request $request)
    {
        if ($request->has(['Cat'])) {
            $_session = Cookie::get('ibkiller_session');
            if ($_session){
                $isLoggedIn = true;
            } else {
                $isLoggedIn = false;
            }
            $api = $this->init();
            $_cat = urldecode(base64_decode($request->Cat));
            $_img = DB::table('subjects')
                ->where('name', $_cat)
                ->select('img')
                ->pluck('img')
                ->first();
            $paperReq = new Request();
            $paperReq->offsetSet('Cat', $_cat);
            $paperReq->offsetSet('Session', $_session);
            return view('category', ['server' => env('APP_URL'), 
                'data' => base64_encode(json_encode(
                    $api->getPapersAPI($paperReq)['result']
                )),
                'subject' => $_cat,
                'img' => $_img,
                'isLoggedIn' => $isLoggedIn,
            ]);
        } else {
            return redirect('/');
        }
    }

    public function question(Request $request)
    {
        if ($request->has(['Paper'])) {
            $_session = Cookie::get('ibkiller_session');
            if ($_session){
                $isLoggedIn = true;
            } else {
                $isLoggedIn = false;
            }
            $api = $this->init();
            $_paper = urldecode(base64_decode($request->Paper));
            $questionReq = new Request();
            $questionReq->offsetSet('Paper', $_paper);
            $result = $api->getDetailOfPaperAPI($questionReq)['result'];
            if (!$result){
                return "Sorry, this paper is not available right now!";
            }
            if ($result[0]['type'] == 1){
                return view('question', ['server' => env('APP_URL'), 
                    'data' => base64_encode(json_encode(
                        $result
                    )),
                    'session' => base64_encode(json_encode(
                        $_session
                    )),
                    'isLoggedIn' => $isLoggedIn,
                    'paper' => $_paper,
                ]);
            } else {
                return view('questionLong', ['server' => env('APP_URL'), 
                    'data' => base64_encode(json_encode(
                        $result
                    )),
                    'session' => base64_encode(json_encode(
                        $_session
                    )),
                    'isLoggedIn' => $isLoggedIn,
                    'paper' => $_paper,
                ]);
            }
            
        } else {
            return redirect('/');
        }
    }

    public function check(Request $request)
    {
        if ($request->has(['PID'])) {
            $_session = Cookie::get('ibkiller_session');
            if ($_session){
                $isLoggedIn = true;
            } else {
                $isLoggedIn = false;
            }
            $api = $this->init();
            $_pid = $request->PID;
            $checkReq = new Request();
            $checkReq->offsetSet('PID', $_pid);
            $result = $api->getDetailOfPIDAPI($checkReq)['result'];
            if ($result == "-100"){
                return redirect('/');
            }
            return view('check', ['server' => env('APP_URL'), 
                'data' => base64_encode(json_encode(
                    $result
                )),
                'isLoggedIn' => $isLoggedIn,
                'paper' => $result['paper'],

            ]);
        } else {
            return redirect('/');
        }
    }

    public function history(Request $request)
    {
        if ($request->has(['Page'])) {
            $_page = (int)($request->Page);
        } else {
            $_page = 1;
        }
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
            return redirect('/');
        }
        $api = $this->init();
        $request->offsetSet('Session', $_session);
        $request->offsetSet('Range', $_page);
        $request->offsetSet('Amount', 8);
        $result = $api->getUserPIDAPI($request);
        return view('history', ['server' => env('APP_URL'), 
            'data' => base64_encode(json_encode(
                $result['result']
            )),
            'isLoggedIn' => $isLoggedIn,
            'isExist' => $result['isExist'],
            'pageNum' => $result['pageNum']
        ]);
    }


    public function message(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
            return redirect('/');
        }
        return view('mateRegister', ['server' => env('APP_URL'), 
            'isLoggedIn' => $isLoggedIn,
        ]);
    }

    public function userLoginAPI(Request $request)
    {
        if ($request->has(['Email','Password'])) {
            $api = $this->init();
            $userM = $api->loginAPI($request);
            if ($userM['success']){
                $cookie = Cookie::forever('ibkiller_session', $userM['session']);
                return back()
                    ->withCookie($cookie);
            } else {
                return back()
                    ->withErrors(['login', $userM['info']]);
            }
        }
    }

    public function userRegisterAPI(Request $request)
    {
        if ($request->has(['Email','Password', 'Name'])) {
            $api = $this->init();
            $userM = $api->registerAPI($request);
            if ($userM['success']){
                $cookie = Cookie::forever('ibkiller_session', $userM['session']);
                return back()
                    ->withCookie($cookie);
            } else {
                return back()
                    ->withErrors(['register', $userM['info']]);
            }
        }
    }

    public function userLogoutAPI(Request $request)
    {
        $cookie = Cookie::forget('ibkiller_session');
        return back()
            ->withCookie($cookie);
    }

    public function confirm(Request $request)
    {
        if ($request->has(['s'])) {
            $api = $this->init();
            $result = $api->confirmAPI($request);
            if ($result['success']){
                return redirect('/');
            } else {
                return 'Error';
            }
        }
    }

    public function resendAuth(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
            return redirect('/');
        }
        $api = $this->init();
        $api->sendAuthEmailWithSession($_session);
    }

    public function userCommitAnswerAPI(Request $request)
    {
        if ($request->has(['Paper','Answer'])) {
            $api = $this->init();
            $_session = Cookie::get('ibkiller_session');
            if (!$_session) {
                $_session = 'Anonymous$K$';
            }
            $_paper = $request->Paper;
            $_answer = $request->Answer;
            $_pid = Hash::make($_session . time() . rand(0, 10000));
            $answerReq = new Request();
            $answerReq->offsetSet('Answer', $_answer);
            $answerReq->offsetSet('Paper', $_paper);
            $answerReq->offsetSet('Session', $_session);
            $answerReq->offsetSet('PID', $_pid);
            $result = $api->commitAnswerAPI($answerReq)['result'];
            if ( $result == "1"){
                return redirect('/check?PID=' . $_pid);
            } else {
                return $result;
            }
        }
    }

    public function userAddFavoriteAPI(Request $request)
    {
        if ($request->has(['Name'])) {
            $_session = Cookie::get('ibkiller_session');
            $api = $this->init();
            if (!$_session) {
                return redirect('/');
            }
            $request->offsetSet('Session', $_session);
            $result = $api->addFavoriteAPI($request);
            return $result;
        }
    }

    public function userDelFavoriteAPI(Request $request)
    {
        if ($request->has(['Name'])) {
            $_session = Cookie::get('ibkiller_session');
            $api = $this->init();
            if (!$_session) {
                return redirect('/');
            }
            $request->offsetSet('Session', $_session);
            $result = $api->delFavoriteAPI($request);
            return $result;
        }
    }

    public function showDiscussionAPI(Request $request)
    {
        if ($request->has(['Paper', 'Range', 'Question'])) {
            $_session = Cookie::get('ibkiller_session');
            $api = $this->init();
            $_range = $request->Range;
            $_paper = $request->Paper;
            $_question = $request->Question;
            $_length = $api->getQuestionNum($_paper);
            $discussionReq = new Request();
            $discussionReq->offsetSet('Paper', $_paper);
            $discussionReq->offsetSet('Range', $_range);
            $discussionReq->offsetSet('Session', $_session);
            $discussionReq->offsetSet('Question', $_question);
            $discussionReq->offsetSet('Amount', 5);
            $result = $api->showDiscussionAPI($discussionReq);
            if (count($result['info'])){
                $result['isDiscussed'] = true;
            } else {
                $result['isDiscussed'] = false;
            }
            return $result;
        }
    }

    public function addDiscussionAPI(Request $request)
    {
        if ($request->has(['Context', 'Paper', 'Question'])) {
            $_session = Cookie::get('ibkiller_session');
            $_paper = $request->Paper;
            $_context = $request->Context;
            $_question = $request->Question;
            $api = $this->init();
            if (!$_session) {
                return ["success" => false, 
                        "info" => "Not Logged In"
                    ];
            }
            $request->offsetSet('Session', $_session);
            $result = $api->addDiscussionAPI($request);
            return $result;
        }
    }

    public function delDiscussionAPI(Request $request)
    {
        if ($request->has(['ID'])) {
            $_session = Cookie::get('ibkiller_session');
            $api = $this->init();
            if (!$_session) {
                return ["success" => false, 
                        "info" => "Not Logged In"
                    ];
            }
            $request->offsetSet('Session', $_session);
            $result = $api->delDiscussionAPI($request);
            return $result;
        }
    }

    public function likeDiscussionAPI(Request $request)
    {
        if ($request->has(['ID'])) {
            $_session = Cookie::get('ibkiller_session');
            $api = $this->init();
            if (!$_session) {
                return ["success" => false, 
                        "info" => "Not Logged In"
                    ];
            }
            $request->offsetSet('Session', $_session);
            $result = $api->likeDiscussionAPI($request);
            return $result;
        }
    }

    public function unlikeDiscussionAPI(Request $request)
    {
        if ($request->has(['ID'])) {
            $_session = Cookie::get('ibkiller_session');
            $api = $this->init();
            if (!$_session) {
                return ["success" => false, 
                        "info" => "Not Logged In"
                    ];
            }
            $request->offsetSet('Session', $_session);
            $result = $api->unlikeDiscussionAPI($request);
            return $result;
        }
    }

    public function showMessageAPI(Request $request)
    {
        if ($request->has(['Range'])) {
            $_session = Cookie::get('ibkiller_session');
            $api = $this->init();
            if (!$_session) {
                return ["success" => false, 
                        "info" => "Not Logged In"
                    ];
            }
            $request->offsetSet('Session', $_session);
            $request->offsetSet('Amount', 3);

            $result = $api->showMessageAPI($request);
            return $result;
        }
    }

    public function readMessageAPI(Request $request)
    {
        if ($request->has(['ID'])) {
            $_session = Cookie::get('ibkiller_session');
            $api = $this->init();
            if (!$_session) {
                return ["success" => false, 
                        "info" => "Not Logged In"
                    ];
            }
            $request->offsetSet('Session', $_session);
            $result = $api->readMessageAPI($request);
            return $result;
        }
    }

    public function readAllMessageAPI(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        $api = $this->init();
        if (!$_session) {
            return ["success" => false, 
                    "info" => "Not Logged In"
                ];
        }
        $request->offsetSet('Session', $_session);
        $result = $api->readAllMessageAPI($request);
        return $result;
    }   
    
    public function countUnreadMessageAPI(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        $api = $this->init();
        if (!$_session) {
            return ["success" => false, 
                    "info" => "Not Logged In"
                ];
        }
        $request->offsetSet('Session', $_session);
        $result = $api->countUnreadMessageAPI($request);
        return $result;
    }   
}