<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credential = $request->validate([
            'username' => ['required','string','exists:users,username'],
            'password'  => 'required'
        ]);

        if(Auth::attempt($credential))
        {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', ' Login failed!');
    }

    public function reset()
    {
        return view('login.reset');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
