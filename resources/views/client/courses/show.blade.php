@extends('layouts.client')

@section('content')
    <div class="container py-5">
        <a href="{{ route('client.courses.index') }}" class="btn btn-link mb-4">&larr; Quay lại danh sách</a>

        <div class="card shadow-sm rounded-4">
            <div class="card-body">
                <h2 class="fw-bold">{{ $course->title }}</h2>
                <p class="text-muted">👨‍🏫 <strong>Giảng viên:</strong> {{ $course->teacher_name }}</p>
                <p class="text-muted">📘 <strong>Số bài học:</strong> {{ $lessons->count() }}</p>
            </div>
        </div>

        <h4 class="mt-5">📂 Danh sách bài học</h4>
        <ul class="list-group list-group-flush mb-5">
            @foreach ($lessons as $lesson)
                <li class="list-group-item">
                    <strong>{{ $lesson->title }}</strong><br>
                    @foreach ($lesson->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag }}</span>
                    @endforeach
                </li>
            @endforeach
        </ul>

        <h4 class="mb-3">💬 Bình luận từ học viên</h4>
        @forelse ($comments as $comment)
            <div class="border rounded-3 p-3 mb-3">
                <p class="mb-1">{{ $comment->content }}</p>
                <small class="text-muted">— {{ $comment->author_name }}
                    ({{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }})
                </small>
            </div>
        @empty
            <p class="text-muted">Chưa có bình luận nào cho khóa học này.</p>
        @endforelse
    </div>
@endsection
