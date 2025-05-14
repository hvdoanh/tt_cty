@extends('layouts.admin')

@section('title', 'Tạo mới khóa học')

@section('content')

    <h2 class="mb-4">Tạo mới khóa học kèm 3 bài học</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.courses.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề khóa học</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tiêu đề" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả khóa học</label>
            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Nhập mô tả" required></textarea>
        </div>

        <h5 class="mt-4">Danh sách bài học</h5>
        <div class="mb-3">
            <input type="text" name="lessons[]" class="form-control mb-2" placeholder="Tiêu đề bài học 1" required>
            <input type="text" name="lessons[]" class="form-control mb-2" placeholder="Tiêu đề bài học 2" required>
            <input type="text" name="lessons[]" class="form-control mb-2" placeholder="Tiêu đề bài học 3" required>
        </div>

        <button type="submit" class="btn btn-primary">Tạo mới</button>
    </form>
@endsection
