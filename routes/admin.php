<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Client\AuthorController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CourseReportController;
use App\Http\Controllers\Admin\LessonController;

// admin


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
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


    // courses
    Route::get('/courses', [AdminCourseController::class, 'index'])->name('admin.courses.index');

    // Thêm khóa học mới
    Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses', [AdminCourseController::class, 'store'])->name('admin.courses.store');

    // Sửa khóa học
    Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('admin.courses.update');

    // Xem chi tiết khóa học
    Route::get('/courses/{course}', [AdminCourseController::class, 'show'])->name('admin.courses.show');

    // Xoá khóa học
    Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('admin.courses.destroy');

    Route::get('/courses-1', [AdminCourseController::class, 'index1']);
    Route::get('/lessons/{id}', [LessonController::class, 'show']);


    Route::get('/courses-with-min-lessons', [CourseReportController::class, 'coursesWithMinLessons']);
    Route::get('/lessons-with-laravel-tag', [CourseReportController::class, 'lessonsWithLaravelTag']);
    Route::get('/top-instructors', [CourseReportController::class, 'topInstructors']);
    Route::get('/comment-count-per-lesson', [CourseReportController::class, 'commentCountPerLesson']);
    Route::get('/courses-with-lesson-count', [CourseReportController::class, 'coursesWithLessonCount']);


    Route::post('/courses/creates', [AdminCourseController::class, 'store1']);
});
