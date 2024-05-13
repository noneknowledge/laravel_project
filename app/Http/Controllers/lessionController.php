<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lession;
use App\Models\Vocab;
use App\Models\Sentence;
use App\Models\Reading;
use App\Models\UserProgress;

use app\Models\LessionTest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class lessionController extends Controller
{

    public function index (){
        $data = lession::all();
        return View("lession.index",compact(['data']));
    }

    public function showInstruction($lessionId)
    {
        $vocabs = Db::table("vocabulary")->where("LessionID",$lessionId)->get();
        $sentences = Db::table('sentence')->where("LessionID",$lessionId)->get();
        $grammars = Db::table('grammar')->where("LessionID",$lessionId)->get();

        return View('lession.instruction',compact(['vocabs','sentences','lessionId','grammars']));
    }

    public function showTest($lessionId){
        $userid = Auth::user()->UserID;

        
      
        $totalVocab = Vocab::whereHas('lessions',function($query) use ($lessionId){
            $query->where('lessionID',$lessionId);
        })->Count();

        $totalSentence =  Sentence::whereHas('lessions',function($query) use ($lessionId){
            $query->where('lessionID',$lessionId);
        })->Count();

        $totalReading =  Reading::whereHas('lessions',function($query) use ($lessionId) {
            $query->where('lessionID',$lessionId);
        })->Count();

   
        $doneVocab = UserProgress::whereHas('vocabs',function($query)  use ($lessionId) {
            $query->whereHas('lessions', function($nestQ)  use ($lessionId){
                $nestQ->where('LessionId',$lessionId);
            });
        })->Count();

        $doneSentence = UserProgress::whereHas('vocabs',function($query)  use ($lessionId) {
            $query->whereHas('lessions', function($nestQ)  use ($lessionId){
                $nestQ->where('LessionId',$lessionId);
            });
        })->Count();

        $doneReading = UserProgress::whereHas('vocabs',function($query)  use ($lessionId) {
            $query->whereHas('lessions', function($nestQ)  use ($lessionId){
                $nestQ->where('LessionId',$lessionId);
            });
        })->Count();
        
        $vocabPercent = (double)number_format($doneVocab/$totalVocab *100,0,'.','');
        $readPercent =  (double)number_format($doneReading/$totalReading *100,0,'.','');
        $senPercent = (double)number_format($doneSentence/$totalSentence*100,0,'.','');
        
        return View('lession.test',compact(['lessionId','doneVocab','doneReading','doneSentence','totalVocab'
        ,'totalReading','totalSentence','vocabPercent','readPercent','senPercent'
    ]));

        
    }

    public function getLession($lessionId){
        $lession = lession::find($lessionId);
        $comments = Db::table("userlession")->where("LessionId",$lessionId)->join('user','userlession.UserID','=','user.UserID')->get();
        
      


        return View("lession.lession",compact(['lession','comments']));
    }
    //
}
