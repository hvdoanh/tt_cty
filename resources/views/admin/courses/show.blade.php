@extends('layouts.admin')

@section('content')
    <h2>{{ $course->title }}</h2>
    <p><strong>Giảng viên:</strong> {{ $course->teacher_name }}</p>

    <h4>Bài học</h4>
    <ul>
        @foreach ($lessons as $lesson)
            <li>{{ $lesson->title }}</li>
        @endforeach
    </ul>
    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">Quay lại danh sách</a>
@endsection
