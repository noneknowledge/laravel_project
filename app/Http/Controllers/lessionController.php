<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lession;
use app\Models\LessionTest;

class lessionController extends Controller
{

    public function index (){
        $data = lession::all();
        return View("admin",compact(['data']));
    }
    //
}
