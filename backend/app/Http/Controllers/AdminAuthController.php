<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function showLoginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'admin';

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->put('user', Auth::user());

            return redirect()->intended('/dashboard');
        }

        return back()
        ->withInput($request->only('email'))
        ->withErrors(['login' => 'Invalid admin credentials']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login.view');
    }

}
