<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
class AppController extends Controller
{
  
    public function val(Request $request)
    {
        return DB::table('internal_user')
            ->where('email' , 'scf@ieee.org')
            ->get();
    }

    public function version(Request $request)
    {
        return "3.0.0 (Laravel)";
    }

    public function getPapers(Request $request)
    {
        $_cat = $request->Cat;
        $_session = $request->Session;
        $allCat = DB::table('groups')
            ->where('cat', $_cat)
            ->get();
        $allCatRes = array();
        foreach ($allCat as $i) {
            $allPaperInGID = DB::table('papers')
                ->where('group_id', $i->group_id)
                ->get();
            $allPaperTemp = array();
            foreach ($allPaperInGID as $j) {
                if ($j->condition == 1){
                    $paperStatus = DB::table('records')
                        ->where([
                            ['paper', $j->paper],
                            ['session', $_session],
                        ])
                        ->get();
                    if ($paperStatus){
                        array_push($allPaperTemp, [$j->paper,$j->totalQuestionNum,0,true, $j->_type]);
                            
                    } else {
                        array_push($allPaperTemp, [$j->paper,$j->totalQuestionNum,0,false, $j->_type]);
                    }
                } else {
                    array_push($allPaperTemp, [$j->paper,$j->totalQuestionNum,1,false, 0]);
                }
                array_push($allCatRes, [
                    'catName' => $i->group_name,
                    'paper' => $allPaperTemp,
                ]);
                unset($allCatRes);
                unset($allPaperTemp);
            }
        }
    }


}
