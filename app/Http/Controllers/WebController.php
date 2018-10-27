<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
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
            ];
            array_push($results, [
                'ibg' => $value->ibg,
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
            $_cat = $request->Cat;
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
            $_paper = $request->Paper;
            $questionReq = new Request();
            $questionReq->offsetSet('Paper', $_paper);
            return view('question', ['server' => env('APP_URL'), 
                'data' => base64_encode(json_encode(
                    $api->getDetailOfPaperAPI($questionReq)['result']
                )),
                'isLoggedIn' => $isLoggedIn,
            ]);
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
            if (!$_session) {
                //return redirect('/');
            }
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
            ]);
        } else {
            return redirect('/');
        }
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
        if ($request->has(['Email','Password', 'Username'])) {
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
}


