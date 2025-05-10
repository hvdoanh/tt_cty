@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>{{ $post->title }}</h1>
        <small class="text-muted">Tạo lúc: {{ $post->created_at->format('d/m/Y H:i') }}</small>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Tác giả:</strong>
            {{ $post->author ? $post->author->name : 'Không xác định' }}
        </div>

        <div class="mb-3">
            <strong>Slug:</strong>
            {{ $post->slug }}
        </div>

        <div class="mb-3">
            <strong>Trạng thái:</strong>
            {{ ucfirst($post->status) }}
        </div>

        <div class="mb-3">
            <strong>Ngày đăng:</strong>
            {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '-' }}
        </div>

        <div class="mb-3">
            <strong>Cập nhật lần cuối:</strong>
            {{ $post->updated_at->format('d/m/Y H:i') }}
        </div>

        <div class="mb-4">
            <strong>Nội dung:</strong>
            <div class="p-3 bg-light rounded">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>
@endsection