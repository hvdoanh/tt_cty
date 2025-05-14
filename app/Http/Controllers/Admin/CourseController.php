<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {


        $courses = DB::table('courses')
            ->leftJoin('users', 'courses.user_id', '=', 'users.id')
            ->leftJoin('lessons', 'courses.id', '=', 'lessons.course_id')
            ->select(
                'courses.id',
                'courses.title',
                'users.name as teacher_name',
                DB::raw('COUNT(lessons.id) as lessons_count')
            )
            ->groupBy('courses.id', 'courses.title', 'users.name')
            ->paginate(10);



        return view('admin.courses.index', compact('courses'));
    }

    // Hiển thị form thêm khóa học
    public function create()
    {
        $teachers = DB::table('users')->get(); // Lấy tất cả giáo viên
        return view('admin.courses.create', compact('teachers'));
    }

    // Lưu khóa học mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'lessons' => 'required|array|min:1',
            'lessons.*' => 'required|string|max:255',
        ]);

        $course = Course::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => Auth::id(), // hoặc $request->user()->id nếu có auth
        ]);

        foreach ($validated['lessons'] as $lessonTitle) {
            $course->lessons()->create([
                'title' => $lessonTitle,
            ]);
        }

        return redirect()->back()->with('success', 'Tạo khóa học & bài học thành công!');
    }
    // Hiển thị form sửa khóa học
    public function edit($courseId)
    {
        $course = DB::table('courses')->where('id', $courseId)->first(); // Lấy thông tin khóa học
        $teachers = DB::table('users')->get(); // Lấy tất cả giáo viên
        return view('admin.courses.edit', compact('course', 'teachers'));
    }

    // Cập nhật khóa học
    public function update(Request $request, $courseId)
    {
        $request->validate([
            'title' => 'required|max:255',
            'teacher_id' => 'required|exists:users,id'
        ]);

        DB::table('courses')->where('id', $courseId)->update([
            'title' => $request->title,
            'user_id' => $request->teacher_id,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Khóa học đã được cập nhật thành công!');
    }

    // Xem chi tiết khóa học
    public function show($courseId)
    {


        $course = DB::table('courses')
            ->leftJoin('users', 'courses.user_id', '=', 'users.id')
            ->select(
                'courses.id',
                'courses.title',
                'users.name as teacher_name'
            )
            ->where('courses.id', $courseId)
            ->first();

        $lessons = DB::table('lessons')
            ->where('course_id', $courseId)
            ->get();

        return view('admin.courses.show', compact('course', 'lessons'));
    }




    // Xoá khóa học
    public function destroy($courseId)
    {
        DB::table('courses')->where('id', $courseId)->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Khóa học đã được xoá!');
    }


    public function index1()
    {
        $courses = Course::with(['user', 'lessons.tags'])->withCount('lessons')->get();

        return response()->json($courses);
    }
}
