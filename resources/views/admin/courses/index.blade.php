@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">📚 Danh sách Khóa học</h2>

        <!-- Thêm Khóa học -->
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Tạo Khóa học mới</a>

        <!-- Thông báo thành công -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Bảng Khóa học -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Giảng viên</th>
                            <th>Số bài học</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->teacher_name ?? 'N/A' }}</td>
                                <td>{{ $course->lessons_count }}</td>
                                <td>
                                    <a href="{{ route('admin.courses.show', $course->id) }}"
                                        class="btn btn-info btn-sm">Xem</a>
                                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xoá khóa học này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xoá</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-4">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
