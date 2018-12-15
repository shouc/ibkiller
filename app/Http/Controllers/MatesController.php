<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Cookie;
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
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
        return view('mateRegister', ['server' => env('APP_URL'), 
            'isLoggedIn' => $isLoggedIn,
        ]);
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
                return 'No mate found.';
            } else {
                DB::table('mate_info')
                    ->where('session', $_session)
                    ->update(['done' => 1]);
                DB::table('mate_info')
                    ->where('session', $_session)
                    ->update(['assigned_session' => $bestMatch->session]);
                DB::table('mate_info')
                    ->where('session', $bestMatch->session)
                    ->update(['done' => 1]);
                DB::table('mate_info')
                    ->where('session', $bestMatch->session)
                    ->update(['assigned_session' => $_session]);
                unset($bestMatch->session);
                unset($bestMatch->assigned_session);
                return json_encode($bestMatch);
            }
        } else {
            return redirect('/mate');
        }
    }
}
