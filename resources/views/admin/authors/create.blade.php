@extends('layouts.admin')

@section('content')
    <h2>Tạo tác giả mới</h2>

    <form action="{{ route('admin.authors.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Tên" class="form-control mb-2">
        <input type="email" name="email" placeholder="Email" class="form-control mb-2">
        <button class="btn btn-success">Tạo</button>
    </form>
@endsection
