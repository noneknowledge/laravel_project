<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class gameController extends Controller
{
    //
    public function duckGame(){


        return View("games.duck",compact([]));
    }
}
