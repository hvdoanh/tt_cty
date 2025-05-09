@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>{{ $post->title }}</h1>
        <small class="text-muted">Tạo lúc: {{ $post->created_at->format('d/m/Y H:i') }}</small>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <h5>Slug:</h5>
            <p>{{ $post->slug }}</p>
        </div>

        <div class="mb-4">
            <h5>Nội dung:</h5>
            <div class="p-3 bg-light rounded">
                {{ $post->content }}
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>
@endsection 