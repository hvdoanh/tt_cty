@extends('layouts.admin')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h3>{{ $author->name }}</h3>
            <p><strong>Email:</strong> {{ $author->email }}</p>
            <p><strong>Số bài viết:</strong> {{ $author->posts->count() }}</p>
            <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-warning">Chỉnh sửa</a>

            <a href="{{ route('admin.authors.index', $author) }}" class="btn btn-success">Quay lại trang danh sách</a>
        </div>
    </div>

    <div class="card-body">



        <h4>Bài viết của tác giả</h4>
        @if ($posts->count())
            <ul class="list-group mb-3">
                @foreach ($posts as $post)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $post->title }}</span>
                        <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-info">Xem bài viết</a>
                    </li>
                @endforeach
            </ul>
            {{ $posts->links() }}
        @else
            <p>Chưa có bài viết nào.</p>
        @endif
    @endsection
