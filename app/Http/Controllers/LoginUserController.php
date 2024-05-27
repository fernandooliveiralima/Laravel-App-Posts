<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    
    public function userLogin()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validate Form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8, string'
        ]);

        // Attempt the log user
        if (Auth::guard('web')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
            return redirect()->intended(route('posts.index'));
        }else{
            return back()->withErrors([
                'email' => 'The Provide Credentials do no match our records'
            ]);
        }

    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('posts.index');
    }

}
