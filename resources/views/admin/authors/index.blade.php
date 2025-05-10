@extends('layouts.admin')

@section('content')
    <h2 class="mb-3">Danh sách Tác giả</h2>
    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary mb-3">Tạo tác giả mới</a>


    {{-- <a href="{{ route('admin.authors.with-many-posts') }}" class="btn btn-info mb-3">Top tác giả có 5 bài viết ↑</a> --}}


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Bài viết</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->email }}</td>
                    <td>{{ $author->posts()->count() }}</td>
                    <td>
                        <a href="{{ route('admin.authors.show', $author) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $authors->links() }}
    </div>
@endsection
