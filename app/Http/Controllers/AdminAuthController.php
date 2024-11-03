<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'admin';

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['login' => 'Invalid admin credentials']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    
}
