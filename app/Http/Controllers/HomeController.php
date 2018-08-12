<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = DB::table('questions')
            ->select('paper')
            ->get();
        $paper = DB::table('questions')
            ->select('paper')
            ->distinct()
            ->get();
        return view('home')
            ->with('res',[count($question),count($paper)]);
    }
    public function add()
    {
        $paper = DB::table('questions')
            ->select("paper")
            ->distinct()
            ->get();
        return view('add')
            ->with('res',$paper);
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
