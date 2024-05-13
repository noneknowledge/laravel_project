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
use Illuminate\Support\Facades\Redirect;

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

    public function finalTest($lessionId){
        $vocabs = Vocab::where('LessionID',$lessionId)->inRandomOrder()->take(5)->get();
        $sentences = Sentence::where('LessionID',$lessionId)->inRandomOrder()->take(3)->get();
        $reading = Reading::where('LessionID',$lessionId)->first();
        dd($reading);
    }

    public function vocabTest($lessionId){
        $userid = Auth::user()->UserID;
        $doneVocab = UserProgress::whereHas('vocabs',function($query)  use ($lessionId) {
            $query->whereHas('lessions', function($nestQ)  use ($lessionId){
                $nestQ->where('LessionId',$lessionId);
            });
        })->Count();

        //Trong may co san loai tron lai roi hay dung lai chua sua view
        $vocab = Vocab::where('LessionID',$lessionId)->skip($doneVocab)->first();
        dd($vocab);
        //nho kiem tra neu null se khong co lam bai vi da hoan thanh

        return View('lession.vocab',$vocab);
    }

    public function nextVocab(Request $req){
        //tao view roi tao form gui post len day
        

    }

    public function resetVocab($lessionId){
        $userid = Auth::user()->UserID;
        //xai where has function
        $userVocab = UserProgress::where('UserID',$userid)->where('LessionID',$lessionId)->delete();


    }


    public function readingTest($lessionId){
        $userid = Auth::user()->UserID;
        $doneReading = UserProgress::whereHas('readings',function($query)  use ($lessionId) {
            $query->whereHas('lessions', function($nestQ)  use ($lessionId){
                $nestQ->where('LessionId',$lessionId);
            });
        })->Count();

        $reading = Vocab::where('LessionID',$lessionId)->skip($doneReading)->first();
        if($reading == null)
        {
            dd($reading);
        }
        
        //nho kiem tra neu null se khong co lam bai vi da hoan thanh

        return View('lession.vocab',$reading);

    }
    
    public function nextReading(Request $req){
        
    }

    public function resetReading($lessionId){

    }

    public function sentenceTest($lessionId){
        $userid = Auth::user()->UserID;
        $doneSentence = UserProgress::where('UserID',$userid)->whereHas('vocabs',function($query)  use ($lessionId) {
            $query->whereHas('lessions', function($nestQ)  use ($lessionId){
                $nestQ->where('LessionId',$lessionId);
            });
        })->Count();
        if($doneSentence > 0){
            $sentence = Sentence::where('lessionID',$lessionId)->skip($doneSentence)->first();
        }
   
        else{
            $sentence = Sentence::where('lessionID',$lessionId)->first();
        }

        $score = 0;
        $index = $doneSentence;

        return View('lession.sentence',compact(['sentence','lessionId','score','index']));

    }

    public function nextSentence(Request $req){
        
        $userid = Auth::user()->UserID;
        $istrue = $req->istrue;
        //Khuc nay nho lay userid cap nhat vao database
        
        
        $index = $req->index +1;
        $score = (int)$req->score;
        $lessionId = $req->lessionId;
        $sentence = Sentence::where('lessionID',$lessionId)->skip($index)->first();
        if ($sentence == null)
        {
            return Redirect("/lession/$lessionId/test");
        }
        return View('lession.sentence',compact(['sentence','lessionId','score','index']));

    }


    public function resetSentence($lessionId){

    }

    public function showTest($lessionId){
        $userid = Auth::user()->UserID;
        //hinh nhu chua ap dung vo bat ky user id cu the nao
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
