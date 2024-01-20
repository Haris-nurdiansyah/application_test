<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'error' => 'Email atau Password salah',
        ]);
    }

    public function register_form()
    {
        return view('register');
    }

    public function register(Request $request) 
    {
        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => false
        ]);
        
        session()->flash('success', 'Register berhasil silahkan login');

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
