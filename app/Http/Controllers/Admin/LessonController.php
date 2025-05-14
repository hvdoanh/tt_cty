<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show($id){
        $lesson = Lesson::with(['comments.user'])->findOrFail($id);

        return response()->json($lesson);
    }
}
