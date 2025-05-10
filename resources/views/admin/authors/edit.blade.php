@extends('layouts.admin')

@section('content')
    <h2>Chỉnh sửa: {{ $author->name }}</h2>

    <form action="{{ route('admin.authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ old('name', $author->name) }}" class="form-control mb-2">
        <input type="email" name="email" value="{{ old('email', $author->email) }}" class="form-control mb-2">
        <button class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
