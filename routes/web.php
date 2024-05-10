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


Route::middleware("auth")->group(function(){
    Route::get('/profile',[userController::class,'showProfile']);
    Route::get('/edit',[userController::class,'editProfile']);
    Route::post('/editProfile',[userController::class,'postProfile']);
});


// Route::prefix('lession')->group(function () {
//     Route::get('/',[lessionController::class,'index']);
//     Route::get('/{lessionId}',[lessionController::class,'index']);
// });

Route::prefix('lession')->controller(lessionController::class)->group(function(){
    Route::get('/',[lessionController::class,'index']);
    Route::get('/{lessionId}',[lessionController::class,'getLession']);

});


Route::controller(userController::class)->group(function () {
    Route::get('/login', 'index')->name('login');

    Route::post('/confirmLogin', 'postLogin')->name("confirmLogin");

    Route::get('/register', 'register');

    Route::post('/logout', 'logOut');


});


// Route::get('/login', [userController::class,'index'])->name('login');

// Route::post('/confirmLogin', [userController::class,'postLogin'])->name("confirmLogin");

// Route::get('/register', [userController::class,'register']);

// Route::post('/register', [userController::class,'postRegister']);


// Route::get('/logout', [userController::class,'logOut']);



