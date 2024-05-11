<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lession;
use app\Models\LessionTest;
use Illuminate\Support\Facades\DB;

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
      

        return View('lession.instruction',compact(['vocabs','sentences','lessionId']));
    }

    public function getLession($lessionId){
        $lession = lession::find($lessionId);
        $comments = Db::table("userlession")->where("LessionId",$lessionId)->join('user','userlession.UserID','=','user.UserID')->get();
        
      


        return View("lession.lession",compact(['lession','comments']));
    }
    //
}
