<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Kiểm tra nếu người dùng là admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này!');
        }

        // Nếu là admin, cho phép truy cập vào dashboard
        return view('admin.dashboard');
    }
}