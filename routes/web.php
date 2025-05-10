<?php

use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Client\AuthorController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';


Route::get('/', function () {
    return view('welcome');
});

// nguoi dung
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/bai-viet/{slug}', [PostController::class, 'showDetail'])->name('client.posts.show');

Route::get('/bai-viet', [PostController::class, 'listForUsers'])->name('client.posts.index');

// web.php
Route::get('/authors', [AuthorController::class, 'index'])->name('client.authors.index');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('client.authors.show');








// admin
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class)->name('admin.dashboard');
    Route::resource('posts', PostController::class)
        ->except(['edit', 'destroy'])
        ->names([
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            'store' => 'admin.posts.store',
            'show' => 'admin.posts.show',
            // 'edit'    => 'admin.posts.edit.slug',
            // 'update'  => 'admin.posts.update.slug',

        ]);
    Route::get('/posts/{slug}/edit', [PostController::class, 'editBySlug'])->name('admin.posts.edit.slug');

    //  Route PUT để xử lý cập nhật bài viết theo slug
    Route::put('/posts/{slug}', [PostController::class, 'update'])->name('admin.posts.update.slug');


    // authors
    Route::resource('authors', AuthorController::class)
        ->names([
            'index'   => 'admin.authors.index',
            'create'  => 'admin.authors.create',
            'store'   => 'admin.authors.store',
            'edit'    => 'admin.authors.edit',
            'update'  => 'admin.authors.update',
            'destroy' => 'admin.authors.destroy',
        ]);
    Route::get('authors/{author}', [AuthorController::class, 'show'])->name('admin.authors.show');

    Route::get('authors/with-many-posts', [AdminAuthorController::class, 'getAuthorsWithManyPosts'])
        ->name('admin.authors.with-many-posts');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});