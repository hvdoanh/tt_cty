<?php

namespace App\Http\Controllers\CLient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class CourseController extends Controller
{
    public function index()
    {
        $courses = FacadesDB::table('courses')
            ->leftJoin('users', 'courses.user_id', '=', 'users.id')
            ->leftJoin('lessons', 'courses.id', '=', 'lessons.course_id')
            ->select(
                'courses.id',
                'courses.title',
                'users.name as teacher_name',
                FacadesDB::raw('COUNT(lessons.id) as lessons_count')
            )
            ->groupBy('courses.id', 'courses.title', 'users.name')
            ->paginate(6);

        return view('client.courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = DB::table('courses')
            ->join('users', 'users.id', '=', 'courses.user_id')
            ->select('courses.*', 'users.name as teacher_name')
            ->where('courses.id', $id)
            ->first();

        // Lấy bài học & tags
        $lessons = DB::table('lessons')
            ->where('course_id', $id)
            ->get()
            ->map(function ($lesson) {
                $tags = DB::table('lesson_tag')
                    ->join('tags', 'tags.id', '=', 'lesson_tag.tag_id')
                    ->where('lesson_tag.lesson_id', $lesson->id)
                    ->pluck('tags.name');
                $lesson->tags = $tags;
                return $lesson;
            });

        // Lấy comment (dùng polymorphic)
        $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('comments.commentable_type', 'courses')
            ->where('comments.commentable_id', $id)
            ->select('comments.content', 'users.name as author_name', 'comments.created_at')
            ->orderByDesc('comments.created_at')
            ->get();

        return view('client.courses.show', compact('course', 'lessons', 'comments'));
    }
}
