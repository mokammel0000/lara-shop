<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('website.auth.register');
    }


    public function postRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        // you can make the password be encrypted in the DB, 
        // you can do it manually as following:
        // $inputs = $request->all();
        // $inputs['password'] = Hash::make($inputs['password']);

        // or you can do it automatically using a mutator in the User Model:
        
        
        $newUser = User::create($request->all());
        if($newUser){
            return redirect('login');
        }
    }


    public function login(){
        return view('website.auth.login');
    }
    public function postlogin(Request $request){
        $credentials = $request->validate([
            // 'email' => 'required|email', 
            'email' => ['required','email'], 
            'password' => 'required', 
        ]);

        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'Either Email or Password is not correct',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');

    }

    
}
