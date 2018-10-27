<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
class WebController extends Controller
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

    public function home(Request $request)
    {
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
            'data' => base64_encode(json_encode($final))]);
    }

}


