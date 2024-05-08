<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Str;




class userController extends Controller
{
    //
    public function index () {
        return view ('login');
    }

    public function register(){
        return view ("register");
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
        
        // $credentials = [
        //     'username' => $username,
        //     'password' => $hashPBase64,
        // ];
  
        if ($user->Password === $hashPBase64)
        {
            $loggedUser = new User();
            $loggedUser->UserName= $user->UserName;
            

            Auth::login($loggedUser);
        
            
        }
    
       

        if (Auth::check ()) {

            dd ('Đăng nhập thành công');
        }
    }
}
