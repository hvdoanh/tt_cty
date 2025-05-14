<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CourseReportController extends Controller
{
    // 1. Khóa học có từ 5 bài học trở lên
    public function coursesWithMinLessons()
    {
        $courses = DB::table('courses')
            ->join('lessons', 'courses.id', '=', 'lessons.course_id')
            ->select('courses.*', DB::raw('COUNT(lessons.id) as lesson_count'))
            ->groupBy('courses.id')
            ->having('lesson_count', '>=', 5)
            ->get();

        return response()->json($courses);
    }

    // 2. Bài học có tag Laravel
    public function lessonsWithLaravelTag()
    {
        $lessons = DB::table('lessons')
            ->join('lesson_tag', 'lessons.id', '=', 'lesson_tag.lesson_id')
            ->join('tags', 'tags.id', '=', 'lesson_tag.tag_id')
            ->where('tags.name', 'Laravel')
            ->select('lessons.*')
            ->distinct()
            ->get();

        return response()->json($lessons);
    }

    // 3. Top 3 giảng viên có nhiều khóa học nhất
    public function topInstructors()
    {
        $instructors = DB::table('users')
            ->join('courses', 'users.id', '=', 'courses.user_id') // user_id
            ->where('users.role', 'teacher') // nếu có cột role phân biệt
            ->select('users.*', DB::raw('COUNT(courses.id) as course_count'))
            ->groupBy('users.id')
            ->orderByDesc('course_count')
            ->limit(3)
            ->get();

        return response()->json($instructors);
    }

    // 4. Số comment mỗi bài học
    public function commentCountPerLesson()
    {
        $lessons = DB::table('lessons')
            ->leftJoin('comments', function ($join) {
                $join->on('lessons.id', '=', 'comments.commentable_id')
                    ->where('comments.commentable_type', '=', 'App\\Models\\Lesson');
            })
            ->select('lessons.id', 'lessons.title', DB::raw('COUNT(comments.id) as comment_count'))
            ->groupBy('lessons.id', 'lessons.title')
            ->get();
        return response()->json($lessons);
    }

    // 5. Khóa học kèm số lượng bài học
    public function coursesWithLessonCount()
    {
        $sub = DB::table('lessons')
            ->select('course_id', DB::raw('COUNT(*) as lesson_count'))
            ->groupBy('course_id');

        $courses = DB::table('courses')
            ->leftJoinSub($sub, 'lesson_counts', function ($join) {
                $join->on('courses.id', '=', 'lesson_counts.course_id');
            })
            ->select('courses.*', DB::raw('IFNULL(lesson_counts.lesson_count, 0) as lesson_count'))
            ->get();

        return response()->json($courses);
    }
}
