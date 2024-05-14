<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLession;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Str;




class userController extends Controller
{
    //
    public function index () {
        return view ('user.login');
    }

    public function register(){
        return view ("user.register");
    }

    public function postRegister(Request $request){
       
        $request->validate([
            'fullname' => 'required',
            'email' => 'required',
            'username' => 'required | unique:user',
            'password' => 'required',
        ]);
        $randomKey = Str::random(5);
 
        $password = $request->password;
        $hashP = hash('sha512',$password.$randomKey);
        $hashPBase64 = base64_encode(hex2bin($hashP));
        
        User::create([
            'FullName' => $request->fullname,
            'UserName' => $request->username,
            'Email' => $request->email,
            'RandomKey'=> $randomKey,
            'Password' => $hashPBase64,
        ]);
        return redirect('/login');
        
      
        
        
    }
    public function showProfile(){
        $curUser = Auth::user();
     
        return View('user.profile',compact(['curUser']));
    }
    public function editProfile(){
        $curUser = Auth::user();

        return View('user.edit',compact(['curUser']));
    }

    public function postComment(Request $req){
        
        $userid = Auth::user()->UserID;
        $date = now()->toDateString();
        $comment = UserLession::updateOrCreate(['UserID'=>$userid,'LessionID'=>(int)$req->lessionid],[
            'Comment'=>$req->comment,

            'CommentDate' => $date,
        ]);
        
        return redirect("lession/$req->lessionid");
    }

    public function postProfile(Request $req){
    
        // dd($req->phone);
        $user = User::updateOrCreate(['UserId'=>(int)$req->userid],[
            'FullName'=>$req->fullname,
        
            'Phone'=> $req->phone,

            'Email' => $req->email,
            
            'DateOfBirth' => $req->dateofbirth
        ]);

        return redirect('/profile');
    }


    public function logOut(){
        Auth::logout();
        return redirect('/lession');
    }

    public function postLogin (Request $request) {
       
       
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $request->input('username');

        $password = $request->input('password');
        
        $user = DB::table ('user')
            ->where ('username', $username )->first();
        
        if ($user === null){
            dd("Null");
        }
   
        $randomKey = $user->RandomKey;
        $hashP = hash('sha512',$password.$randomKey);
        $hashPBase64 = base64_encode(hex2bin($hashP));
    
        if ($user->Password === $hashPBase64)
        {
            $logIn = User::where('UserID',$user->UserID)->first();
            Auth::login($logIn);
        }

        return redirect('/lession');
    }
}
