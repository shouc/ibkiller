<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Cookie;
class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            return redirect('/');
        }
        $subjects = DB::table('subjects')
            ->get();

        $stats = DB::table('contribution_stats')
            ->where('session', $_session)
            ->first();
        if ($stats) {
            $statsResult = [$stats->amount_contributed, 
                $stats->amount_used,
                $stats->points,
            ];
            $isNew = false;
        } else {
            $statsResult = [0, 0, 0];
            $isNew = true;
        }
        return view('home', ['isLoggedIn' => $isLoggedIn,
            'res' => $statsResult,
            'data' => $subjects,
            'isNew' => $isNew,
        ]);
        
    }
    public function help(){
        return redirect('/help.html');
    }
    public function add()
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            return redirect('/');
        }
        return view('add', ['isLoggedIn' => $isLoggedIn]);
    }
    public function modify(Request $request)
    {
        $paper = DB::table('questions')
            ->select("paper")
            ->distinct()
            ->get();
        $question = DB::table('questions')
            ->where('ref',base64_decode($request->ref))
            ->get();
        return view('modify')
            ->with('res',[$paper,$question]);
    }
    public function bulk(Request $request)
    {
        $page = 1;
        if ($request->page){
            $page = $request->page;
        }
        $questionAll = DB::table('questions')
            ->get();

        $total = count($questionAll) / 10;
        $question = DB::table('questions')
            ->offset(($page - 1) * 10)
            ->limit(10)
            ->get();
        $res = "";
        //return $question;
        foreach ($question as &$value) {
            if (strpos($value->ok_by, Auth::user()->name ) > 0){
                $res = $res . $value->question . 'Answer: <strong>' . $value->answer . '</strong><br>Ref: <a href=modify?ref=' . base64_encode($value->ref) . '><em>' . $value->ref . '</em><a><br>Validated by: <a><em>' . str_replace('@', ', ', substr($value->ok_by, 1)) . '</em><a><br><br>';
            } else {
                $res = $res . $value->question . 'Answer: <strong>' . $value->answer . '</strong><br>Ref: <a href=modify?ref=' . base64_encode($value->ref) . '><em>' . $value->ref . '</em><a><br>Validated by: <a><em>' . str_replace('@', ', ', substr($value->ok_by, 1)) . '</em><a><br><a href=api/val?ref=' . base64_encode($value->ref) . '><button class="btn btn-secondary">Validate</button></a>&nbsp;&nbsp;<a href=modify?ref=' . base64_encode($value->ref) . '><button class="btn btn-primary">Modify</button></a><br><br>';
            }
            
        }
        $res = str_replace('"',"'",$res);
        $res = str_replace('“',"'",$res);
        $res = str_replace('”',"'",$res);
        $res = str_replace(PHP_EOL,"",$res);
        return view('bulk')
            ->with('res', [$res, $total]);
    }

}
