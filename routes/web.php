<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\userController;
use App\Http\Controllers\lessionController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('test')->group(function () {
    Route::get('/',[lessionController::class,'index']);

});

Route::get('/login', [userController::class,'index']);

Route::post('/confirmLogin', [userController::class,'postLogin'])->name("confirmLogin");

Route::get('/register', [userController::class,'register']);

Route::post('/register', [userController::class,'postRegister']);



