<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function loginSubmit(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt($validated)){
            return back()->withInput()->withErrors(['login'=>'نام کاربری یا رمز عبور اشتباه است.']);
        }

        // TODO: redirect to right place
        return redirect()->route('welcome');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
