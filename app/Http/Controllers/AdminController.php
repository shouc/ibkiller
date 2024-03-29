<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Hash;
use Cookie;
use Mail;
use Redis;
use Omnipay\Omnipay;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indexOld(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
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

        return view('adminHomeOld')
            ->with('res',[count($counter),count($arr)])
            ->with('isLoggedIn', $isLoggedIn)

            ->with('data', $subject)
            ->with('types', $types);
    }
    public function addOld()
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
        $paper = DB::table('questions')
            ->select("paper")
            ->distinct()
            ->get();
        return view('adminAddOld')
            ->with('isLoggedIn', $isLoggedIn)
            ->with('res',$paper);
    }
    public function modifyOld(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
        $paper = DB::table('questions')
            ->select("paper")
            ->distinct()
            ->get();
        $question = DB::table('questions')
            ->where('ref',base64_decode($request->ref))
            ->get();
        return view('adminModifyOld')
            ->with('isLoggedIn', $isLoggedIn)
            ->with('res',[$paper,$question]);
    }
    public function bulkOld(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
        $page = 1;
        if ($request->page){
            $page = $request->page;
        }
        $questionAll = DB::table('questions')
            ->where('ul', null)
            ->get();

        $total = count($questionAll) / 10;
        $question = DB::table('questions')
            ->where('ul', null)
            ->offset(($page - 1) * 10)
            ->limit(10)
            ->get();
        $res = "";
        //return $question;
        foreach ($question as &$value) {
            if (strpos($value->ok_by, Auth::user()->name ) > 0){
                $res = $res . $value->question . 'Answer: <strong>' . $value->answer . '</strong><br>Ref: <a href=/admin/modify?ref=' . base64_encode($value->ref) . '><em>' . $value->ref . '</em><a><br>Validated by: <a><em>' . str_replace('@', ', ', substr($value->ok_by, 1)) . '</em><a><br><br>';
            } else {
                $res = $res . $value->question . 'Answer: <strong>' . $value->answer . '</strong><br>Ref: <a href=/admin/modify?ref=' . base64_encode($value->ref) . '><em>' . $value->ref . '</em><a><br>Validated by: <a><em>' . str_replace('@', ', ', substr($value->ok_by, 1)) . '</em><a><br><a href=/admin/api/val?ref=' . base64_encode($value->ref) . '><button class="btn btn-secondary">Validate</button></a>&nbsp;&nbsp;<a href=/admin/modify?ref=' . base64_encode($value->ref) . '><button class="btn btn-primary">Modify</button></a><br><br>';
            }

        }
        $res = str_replace('"',"'",$res);
        $res = str_replace('“',"'",$res);
        $res = str_replace('”',"'",$res);
        $res = str_replace(PHP_EOL,"",$res);
        return view('adminBulkOld')
            ->with('isLoggedIn', $isLoggedIn)
            ->with('res', [$res, $total]);
    }

    public function questionsJSON(Request $request)
    {
        $res = DB::table('questions')

            ->get();
        foreach ($res as $k=>&$value) {
            $paper = DB::table('papers')
                ->where('paper', $value->paper)
                ->distinct()
                ->get();

            if ($paper[0] == substr($request->cat,0,1)){
                $value->mod = '<a href=/admin/modify?ref=' . base64_encode($value->ref) . '><button class="btn btn-primary"> Modify </button></a>';
                $value->ok_by = str_replace('@', ', ', substr($value->ok_by, 1));
            } else {

                unset($res[$k]);
            }
        }
        unset($value);
        return response()->json($res);
    }

    public function papersJSON(Request $request)
    {

        $res = DB::table('papers')
            ->get();
        $arr = array();
        foreach ($res as $k=>&$value) {
            $groups = DB::table('groups')
                ->where('group_id', $value->group_id)
                ->get();
            if ($groups[0]->cat == $request->cat){
                array_push($arr,[
                    'paper' => $value->paper,
                    '_type' => $value->_type,
                    'totalQuestionNum' => $value->totalQuestionNum,
                    'condition' => $value->condition,
                    'subject' => $groups[0]->group_name,
                    'subject_ref' =>$groups[0]->group_id,
                    'mod' => '<a onclick=modal1("' . base64_encode($value->paper) . '")><button class="btn btn-primary" data-toggle="modal" data-target="#modal1"> Modify </button></a>',

                ]);
            }
        }
        unset($value);

        return response()->json($arr);
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
    public function paperModify(Request $request){
        $questions = DB::table('questions')
            ->where('paper',base64_decode($request->ref))
            ->get();
        $html = "";
        foreach ($questions as $question){
            if (strpos($question->ok_by, Auth::user()->name ) > 0){
                $html = $html . $question->question . 'Answer: <strong>' . $question->answer . '</strong><br>Ref: <a href=/admin/modify?ref=' . base64_encode($question->ref) . '><em>' . $question->ref . '</em><a><br>Validated by: <a><em>' . str_replace('@', ', ', substr($question->ok_by, 1)) . '</em><a><br><a onclick=del("' . base64_encode($question->ref) . '","' . $request->ref .'")><button class="btn btn-secondary">Delete</button></a><br><br>';
            } else {
                $html = $html . $question->question . 'Answer: <strong>' . $question->answer . '</strong><br>Ref: <a href=/admin/modify?ref=' . base64_encode($question->ref) . '><em>' . $question->ref . '</em><a><br>Validated by: <a><em>' . str_replace('@', ', ', substr($question->ok_by, 1)) . '</em><a><br><br><a href=/admin/api/val?ref=' . base64_encode($question->ref) . '><button class="btn btn-primary">Validate</button></a>&nbsp;&nbsp;<a onclick=del("' . base64_encode($question->ref) . '","' . $request->ref .'")><button class="btn btn-secondary">Delete</button></a><br><br>';
            }
        }
        return [$request->ref, $html];
    }

    public function del(Request $request)
    {
        $question = DB::table('questions')
            ->where('ref', base64_decode($request->ref))
            ->update(['paper' => 'DEL']);

        $paper = DB::table('papers')
            ->where('paper', base64_decode($request->paper))
            ->decrement('totalQuestionNum');
        return "ok";
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
        $paper = DB::table('papers')
            ->where('paper', $request->paper)
            ->increment('totalQuestionNum');

        echo '<script type="text/javascript">'
        , 'history.go(-2);'
        , 'alert("提交成功");'
        , '</script>';
    }
    public function val(Request $request)
    {
        return DB::table('internal_user')
            ->where('email' , 'scf@ieee.org')
            ->get();
    }

    public function upload(Request $request){
        if ($request->isMethod('POST')) {
            $fileCharater = $request->file('editormd-image-file');

            if ($fileCharater->isValid()) {
                $ext = $fileCharater->getClientOriginalExtension();
                $path = $fileCharater->getRealPath();
                $filename = date('Y-m-d-h-i-s').'.'.$ext;
                Storage::disk('public')->put($filename, file_get_contents($path));
            }
        }
        return response()->json([
            'success' => 1,
            'message' => '',
            'url' =>  env('APP_URL') . '/storage/' . $filename]);
    }
}
