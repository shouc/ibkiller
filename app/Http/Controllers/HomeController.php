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
    public function index(Request $request)
    {

        $sub = $request->subject ? request()->subject : 'Chemistry';
        $fsubject = DB::table('groups')
            ->where('cat', $sub)
            ->distinct()
            ->get();
        $arr = array();
        foreach($fsubject as $value){
            $cat = DB::table('papers')
                ->where('group_id',$value->group_id)
                ->select('paper')
                ->distinct()
                ->get();
            foreach($cat as $svalue){
                array_push($arr, $svalue->paper);
            }
            
        };
        $counter = array();
        foreach($arr as $tvalue){
            $question = DB::table('questions')
                ->where('paper',$tvalue)
                ->get();
            foreach($question as $fvalue){
                array_push($counter, $fvalue->ref);
            }

        }
        
        $subject = DB::table('groups')
            ->select('cat')
            ->distinct()
            ->get();
        $types = DB::table('groups')
            ->where('cat', $sub)
            ->get();
        
        return view('home')
            ->with('res',[count($counter),count($arr)])
            ->with('data', $subject)
            ->with('types', $types);
    }
    public function help(){
        return redirect('/help.html');
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
