<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Cookie;
use Storage;
class ContributeController extends Controller
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
        return view('contribute', ['isLoggedIn' => $isLoggedIn,
            'res' => $statsResult,
            'data' => $subjects,
            'isNew' => $isNew,
        ]);
        
    }

    public function add(Request $request)
    {
        if ($request->has(['Subject'])) {
            $_subject = $request->Subject;
            $_session = Cookie::get('ibkiller_session');
            if ($_session){
                $isLoggedIn = true;
            } else {
                return redirect('/');
            }
            $data = DB::table('groups')
                ->where('cat', $_subject)
                ->get()
                ->toArray();
            return view('add', ['isLoggedIn' => $isLoggedIn,
                'data' => $data,
            ]);
        }
    }

    public function adminAdd(Request $request)
    {
        $_session = Cookie::get('ibkiller_session');
        if ($_session){
            $isLoggedIn = true;
        } else {
            return redirect('/');
        }
        return view('adminAdd', ['isLoggedIn' => $isLoggedIn]);
    }

    public function userAddQuestion(Request $request)
    {
        if ($request->has(['Subject', 'Content', 'Answer', 'Chapter', 'Type'])) {
            $_session = Cookie::get('ibkiller_session');
            $_subject = $request->Subject;
            $_content = $request->Content;
            $_answer = $request->Answer;
            $_chapter = $request->Chapter;
            $_type = $request->Type;
            if ($_session){
                $isLoggedIn = true;
            } else {
                return redirect('/');
            }
            //if ()
            DB::table('contribution')
                ->insert([
                    'session' => $_session,
                    'subject' => $_subject,
                    'content' => $_content,
                    'answer' => $_answer,
                    'chapter' => $_chapter,
                    'type' => (int)$_type,
                    'time' => (int)time(),
                ]
            );

            if(!DB::table('contribution_stats')
                ->where('session', $_session)
                ->first()){
                DB::table('contribution_stats')
                    ->insert([
                        'session' => $_session,
                        'amount_contributed' => 1,
                        'amount_used' => 0,
                        'points' => 0,
                    ]
                );
            } else {
                DB::table('contribution_stats')
                    ->where('session', $_session)
                    ->increment('amount_contributed');
            }
            return redirect('/contribute');
        }
    }

    public function adminAddQuestion(Request $request)
    {
        if ($request->has(['Content', 'Answer', 'Paper', 'Type', 'QuestionType'])) {
            $_session = Cookie::get('ibkiller_session');
            $_content = $request->Content;
            $_answer = $request->Answer;
            $_paper = $request->Paper;
            $_type = $request->Type;
            $_qType = $request->QuestionType;

            if ($_session){
                $isLoggedIn = true;
            } else {
                return redirect('/');
            }
            //if ()
            DB::table('questions')
                ->insert([
                    'question' => base64_decode($_content),
                    'answer' => base64_decode($_answer),
                    'type' => (int)$_type,
                    'paper' => $_paper,
                    'ref' => $_paper . '@' . $_qType,
                ]
            );

            
            return redirect('/contribute/adminAdd');
        }
    }

    public function userModifyQuestion(Request $request)
    {
        if ($request->has(['ref', 'Subject', 'Content', 'Answer', 'Chapter', 'Type'])) {
            $_session = Cookie::get('ibkiller_session');
            $_ref = $request->ref;
            $_subject = $request->Subject;
            $_content = $request->Content;
            $_answer = $request->Answer;
            $_chapter = $request->Chapter;
            $_type = $request->Type;
            if ($_session){
                $isLoggedIn = true;
            } else {
                return redirect('/');
            }
            
            DB::table('contribution')
                ->where([
                    ['id', $_ref],
                    ['session', $_session],
                ])
                ->delete();
            DB::table('contribution')
                ->insert([
                    'session' => $_session,
                    'subject' => $_subject,
                    'content' => $_content,
                    'answer' => $_answer,
                    'chapter' => $_chapter,
                    'type' => (int)$_type,
                    'time' => (int)time(),
                ]
            );
            return redirect('/contribute');
        }
    }

    public function showContributedQuestion(Request $request)
    {
        if ($request->has(['Subject'])) {
            $_session = Cookie::get('ibkiller_session');
            $_subject = $request->Subject;
            if ($_session){
                $isLoggedIn = true;
            } else {
                return redirect('/');
            }
            $data = DB::table('contribution')
                ->where([['session', $_session], ['subject', $_subject]])
                ->orderBy('id', 'DESC')
                ->get();
            foreach ($data as $i => $value) {
                unset($value->session);
                if (strlen(base64_decode($value->content)) >= 10){
                    $value->content = substr(base64_decode($value->content), 0, 10) . '...';
                } else {
                    $value->content = base64_decode($value->content);
                }
                if (strlen(base64_decode($value->answer)) >= 10){
                    $value->answer = substr(base64_decode($value->answer), 0, 10) . '...';
                } else {
                    $value->answer = base64_decode($value->answer);
                }
                if ($value->type == 1){
                    $value->type = 'Multiple Choice';
                } elseif ($value->type == 2) {
                    $value->type = 'Short Answer/Essay';
                } else {
                    $value->type = 'Error';
                }
                $value->time = date("m/d H:i", $value->time);
                $value->modify = '<a href=/contribute/modify?ref=' . $value->id . '&Subject='. $_subject . '><button class="btn btn-primary"> Modify </button></a>';
            }
            return json_encode($data);
        }
    }

    public function upload(Request $request){
        if ($request->isMethod('POST')) {
            $fileCharater = $request->file('editormd-image-file');
 
            if ($fileCharater->isValid()) {
                $ext = $fileCharater->getClientOriginalExtension();
                $path = $fileCharater->getRealPath();
                $filename = 'userUpload/' . date('Y-m-d-h-i-s').'.'.$ext;
                Storage::put($filename, file_get_contents($path));
            }
        }
        return response()->json([
            'success' => 1,
            'message' => '',
            'url' =>  'https://cdn-bucket.ibkiller.com/' . $filename
        ]);
    }

    public function modify(Request $request){
        if ($request->has(['ref', 'Subject'])) {
            $_ref = $request->ref;
            $_subject = $request->Subject;

            $_session = Cookie::get('ibkiller_session');
            if ($_session){
                $isLoggedIn = true;
            } else {
                return redirect('/');
            }
            $data = DB::table('groups')
                ->where('cat', $_subject)
                ->get()
                ->toArray();
            $userContent = DB::table('contribution')
                ->where([['session', $_session], ['id', $_ref]])
                ->first();
            return view('modify', ['isLoggedIn' => $isLoggedIn,
                'data' => $data,
                'userContent' => $userContent,
            ]);
        }
    }

}
