<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Cookie;
use App\Mail\MateEmail;
use Mail;
class MatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function calculateDistance($from, $to) 
    {
        $radLat1 = deg2rad($from[0]);
        $radLat2 = deg2rad($to[0]);
        $radLng1 = deg2rad($from[1]);
        $radLng2 = deg2rad($to[1]);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $distance = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137;
        return $distance;
    }

    public function sendHaveMate($mailAddr)
    {
        Mail::to($mailAddr)->send(new MateEmail('haveMate', 'You have a mate!!'));
    }

    public function sendDisbandMate($mailAddr)
    {
        Mail::to($mailAddr)->send(new MateEmail('disbandMate', 'Your mate hope to disband with you!'));
    }

    public function sendMateAlsoDisbanded($mailAddr)
    {
        Mail::to($mailAddr)->send(new MateEmail('mateAlsoDisbanded', 'Your mate also disbands you!'));
    }

    public function checkIsAuth($session)
    {
        $userInfo = DB::table('app_users')
            ->where('session', $session)
            ->first();
        if ($userInfo == ""){
            return 'error';
        }
        return $userInfo->is_auth;
    }

    public function calculateDeterminant($mateUndone, $_grade, $parsedLocation)
    {
        $gradeDeterminant = (float)abs($mateUndone->grade - $_grade) * 0.6 / 4;
        $parsedMateLocation = explode('!!', $mateUndone->location);
        $distanceDeterminant = $this->calculateDistance($parsedLocation, $parsedMateLocation) * 0.4/ 14000;
        unset($parsedMateLocation);
        $totalDeterminant = 1.0 - $gradeDeterminant - $distanceDeterminant;
        return $totalDeterminant;
    }
    
    public function index(Request $request)
    {
        //state 1 for have mate % 2 for disband guy % 3 for disband mate
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
        $mateInfo = DB::table('mate_info')
            ->where('session', $_session)
            ->get()
            ->first();
        if ($mateInfo == ""){
            return view('mateRegister', ['server' => env('APP_URL'), 
                'isLoggedIn' => $isLoggedIn,
                'isAuthed' => $this->checkIsAuth($_session)
            ]);
        } else {
            $assignedMate = DB::table('mate_info')
                ->where('assigned_session', $_session)
                ->first();
            if ($assignedMate != ""){
                $assignedMateInfo = DB::table('app_users')
                    ->where('session' , $assignedMate->session)
                    ->first();
                return view('haveMate', ['server' => env('APP_URL'), 
                    'isLoggedIn' => $isLoggedIn,
                    'assignedMateName' => $assignedMateInfo->name,
                    'assignedMateInterest' => $assignedMate->preference,
                    'assignedMateGender' => $assignedMate->gender,
                    'assignedMateGrade' => $assignedMate->grade,
                    'assignedMateContact' => $assignedMateInfo->email,
                    'status' => $mateInfo->done,
                ]);
            } else {
                return view('noMate', ['server' => env('APP_URL'), 
                    'isLoggedIn' => $isLoggedIn,
                ]); 
            }
            
        } 
    }
    public function findMate(Request $request)
    {   
        if ($request->has(['Grade', 'Location', 'Interest', 'Gender'])) {
            $_session = Cookie::get('ibkiller_session');
            $_grade = (int)($request->Grade);
            $_location = $request->Location;
            $parsedLocation = explode('!!', $_location); //lat!!lng
            $_preference = $request->Interest;
            $_gender = (int)($request->Gender); //0 for male, 1 for female
            if ($_session){
                $isLoggedIn = true;
            } else {
                $isLoggedIn = false;
                return redirect('/');
            }
            if(DB::table('mate_info')
                ->where('session', $_session)
                ->get() != "[]"){
                return 'already';
            }
            DB::table('mate_info')
                ->insert([
                    'session' => $_session,
                    'done' => 0,
                    'grade' => $_grade,
                    'gender' => $_gender,
                    'location' => $_location,
                    'preference' => $_preference,
                    'time' => time()
                ]);
            $allMatesUndone = DB::table('mate_info')
                ->where([
                    ['done', 0], 
                    ['gender', '!=', $_gender],
                ])
                ->get()
                ->toArray();
            $highestDeterminant = 0.8;
            $bestMatch = null;
            foreach ($allMatesUndone as $i => $mateUndone) {
                $currentDeterminant = $this->calculateDeterminant($mateUndone, $_grade, $parsedLocation);
                if ($currentDeterminant >= $highestDeterminant){
                    $highestDeterminant = $currentDeterminant;
                    $bestMatch = $mateUndone;
                }
            }
            if ($bestMatch == null){
                return redirect('/mate');
            } else {
                $bestMatchInfo = DB::table('app_users')
                    ->where('session' , $bestMatch->session)
                    ->first();
                $matcheeInfo = DB::table('app_users')
                    ->where('session' , $_session)
                    ->first();
                DB::table('mate_info')
                    ->where('session', $_session)
                    ->update(['assigned_session' => $bestMatch->session,
                              'mate_email' => $bestMatchInfo->email,
                              'done' => 1
                ]);
                DB::table('mate_info')
                    ->where('session', $bestMatch->session)
                    ->update(['assigned_session' => $_session, 
                              'mate_email' => $matcheeInfo->email,
                              'done' => 1
                ]);
                $this->sendHaveMate($bestMatchInfo->email);
                unset($bestMatch->session);
                unset($bestMatch->assigned_session);
                return redirect('/mate');
            }
        } else {
            return redirect('/mate');
        }
    }
    public function disband(Request $request)
    {   
        $_session = Cookie::get('ibkiller_session');
        $userInfo = DB::table('mate_info')
            ->where('session', $_session)
            ->first();
        $mateInfo = DB::table('mate_info')
            ->where('session', $userInfo->assigned_session)
            ->first();
        if ($mateInfo == "" || $mateInfo->done == 0){
            return "403";
        } else {
            if ($mateInfo->done == 2){
                DB::table('mate_info')
                    ->where('session', $_session)
                    ->delete();
                DB::table('mate_info')
                    ->where('session', $mateInfo->session)
                    ->delete();
                $this->sendMateAlsoDisbanded($userInfo->mate_email);
            } else {
                DB::table('mate_info')
                    ->where('session', $_session)
                    ->update(['done' => 2]);
                DB::table('mate_info')
                    ->where('session', $mateInfo->session)
                    ->update(['done' => 3]);
                $this->sendDisbandMate($userInfo->mate_email);
            }
        }
        return redirect('/mate');
    }
    
}
