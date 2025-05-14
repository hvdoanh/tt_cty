<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\AuthorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CLient\CourseController;


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';


Route::get('/', function () {
    return view('welcome');
});

// nguoi dung
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::get('/bai-viet/{slug}', [PostController::class, 'showDetail'])->name('client.posts.show');

Route::get('/bai-viet', [PostController::class, 'listForUsers'])->name('client.posts.index');

// web.php
Route::get('/authors', [AuthorController::class, 'index'])->name('client.authors.index');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('client.authors.show');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/courses', [CourseController::class, 'index'])->name('client.courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('client.courses.show');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');