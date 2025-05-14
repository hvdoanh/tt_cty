<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // giữ nguyên giao diện login của Breeze
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        session()->flash('error', 'Email hoặc mật khẩu không đúng.');
        return back()->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Xóa session user
        $request->session()->invalidate(); // Xóa toàn bộ session
        $request->session()->regenerateToken(); // Reset CSRF token

        return redirect('/login'); // Về trang login
    }
}