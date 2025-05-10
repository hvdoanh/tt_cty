@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h1>Tạo bài viết mới</h1>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf

            {{-- Author --}}
            <div class="mb-3">
                <label for="author_id" class="form-label">Tác giả</label>
                <select class="form-control @error('author_id') is-invalid @enderror" name="author_id" id="author_id">
                    <option value="">-- Chọn tác giả --</option>
                    @foreach(\App\Models\Author::all() as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                    id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                    id="content" name="content" rows="10">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Công khai</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Lưu trữ</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Published At --}}
            <div class="mb-3">
                <label for="published_at" class="form-label">Ngày đăng (nếu có)</label>
                <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                    id="published_at" name="published_at" value="{{ old('published_at') }}">
                @error('published_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">Tạo bài viết</button>
            </div>
        </form>
    </div>
</div>
@endsection