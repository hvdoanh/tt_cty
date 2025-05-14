@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">📚 Sửa Khóa học</h2>

        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Tiêu đề khóa học</label>
                <input type="text" id="title" name="title" class="form-control"
                    value="{{ old('title', $course->title) }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="teacher_id">Giảng viên</label>
                <select id="teacher_id" name="teacher_id" class="form-control">
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $course->user_id == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-warning mt-3">Cập nhật</button>
        </form>
    </div>
@endsection
