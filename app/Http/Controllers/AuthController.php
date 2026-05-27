<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function update(Request $request){
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'national_code'=> 'required|digits:10|unique:users,national_code,'.$request->user()->id,
            'phone'=> 'required|regex:/^09\d{9}$/',
            'address'=> 'required',
        ]);
        auth()->user()->update($validated);
        return back()->with('update-success',true);
    }
    public function profile()
    {
        return view('auth.profile');
    }
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

        if(!Auth::attempt($validated,true)){
            return back()->withInput()->withErrors(['login'=>'نام کاربری یا رمز عبور اشتباه است.']);
        }

        return redirect(auth()->user()->redirectRoute());
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}
