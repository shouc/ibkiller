<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class QuestionController extends Controller
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
     * Show the questions.
     *
     * @return JSON
     */
    public function questionsJSON()
    {
        $res = DB::table('questions')
            ->get();
        foreach ($res as &$value) {
            $value->mod = '<a href=modify?ref=' . base64_encode($value->ref) . '><button class="btn btn-primary"> Modify </button></a>';
            $value->ok_by = str_replace('@', ', ', substr($value->ok_by, 1));
        }
        unset($value);
            
        return response()->json($res);
    }

    public function stats()
    {
        $question = DB::table('questions')
            ->select('paper')
            ->get();
        $paper = DB::table('questions')
            ->select('paper')
            ->distinct()
            ->get();
        
        return response()->json([count($question),count($paper)]);
    }

    public function modify(Request $request)
    {
        $new = DB::table('questions')
            ->where('ref',base64_decode($request->ref))
            ->get();
        if (strpos($new[0]->ok_by, Auth::user()->name ) > 0){
            $question = DB::table('questions')
            ->where('ref',base64_decode($request->ref))
            ->update(['paper' => $request->paper,
                'answer' => $request->answer,
                'chapter' => $request->chapter,
                'type' => $request->type,
                'mark' => $request->mark,
                'question' => $request->question]);
        } else {
            $question = DB::table('questions')
            ->where('ref',base64_decode($request->ref))
            ->update(['paper' => $request->paper,
                'answer' => $request->answer,
                'chapter' => $request->chapter,
                'type' => $request->type,
                'mark' => $request->mark,
                'question' => $request->question,
                'ok_by' => $new[0]->ok_by  . '@' . Auth::user()->name]);
        }
        

        echo '<script type="text/javascript">'
               , 'history.go(-2);'
               , 'alert("提交成功");'
               , '</script>';
    }
    public function add(Request $request)
    {
        $question = DB::table('questions')
            ->insert(['paper' => $request->paper,
                'answer' => $request->answer,
                'chapter' => $request->chapter,
                'type' => $request->type,
                'mark' => $request->mark,
                'ref' => 'web@' . $request->qtype . '@' . $request->chapter . '@' . time() . rand(1000,10000),
                'question' => $request->question,
                'ok_by' => '@' . Auth::user()->name]);
        
        echo '<script type="text/javascript">'
               , 'history.go(-2);'
               , 'alert("提交成功");'
               , 'location.reload();'
               , '</script>';
    }
    public function val(Request $request)
    {
        $new = DB::table('questions')
            ->where('ref',base64_decode($request->ref))
            ->get();
        if (strpos($new[0]->ok_by, Auth::user()->name ) > 0){
            return "error";
        } else {
            $question = DB::table('questions')
                ->where('ref',base64_decode($request->ref))
                ->update([
                    'ok_by' => $new[0]->ok_by  . '@' . Auth::user()->name]);
        }
        echo '<script type="text/javascript">'
               , 'history.go(-1);'
               , 'alert("提交成功");'
               , '</script>';
    }
}
