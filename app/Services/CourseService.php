<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CourseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getCoursesWithMinLessons($min = 5)
    {
        return DB::table('courses')
            ->join('lessons', 'courses.id', '=', 'lessons.course_id')
            ->select('courses.id', 'courses.title', DB::raw('COUNT(lessons.id) as lesson_count'))
            ->groupBy('courses.id', 'courses.title')
            ->having('lesson_count', '>=', $min)
            ->get();
    }
}
