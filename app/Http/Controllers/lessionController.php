<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lession;
use app\Models\LessionTest;

class lessionController extends Controller
{

    public function index (){
        $data = lession::all();
        return View("lession.index",compact(['data']));
    }

    public function getLession($lessionId){
        $lession = lession::find($lessionId);
        dd($lession);

        return View("lession.lession",compact(['lessionId']));
    }
    //
}
