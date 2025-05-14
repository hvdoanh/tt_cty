@extends('layouts.client')

@section('content')
    <div class="container">
        <h2 class="mb-4">📚 Danh sách Khóa học</h2>

        <div class="row">
            @forelse ($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text mb-1"><strong>👨‍🏫 Giảng viên:</strong> {{ $course->teacher_name ?? 'N/A' }}
                            </p>
                            <p class="card-text"><strong>📘 Bài học:</strong> {{ $course->lessons_count }}</p>
                            <a href="{{ route('client.courses.show', $course->id) }}"
                                class="btn btn-sm btn-outline-primary mt-2">Chi tiết</a>
                            {{-- mua hàng --}}
                            <a href="#" class="btn btn-sm btn-outline-success mt-2">Mua khóa học</a>
                            {{-- thêm vào giỏ hàng --}}
                            <a href="#" class="btn btn-sm btn-outline-warning mt-2">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Không có khóa học nào.</p>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $courses->links() }}
    </div>
@endsection
