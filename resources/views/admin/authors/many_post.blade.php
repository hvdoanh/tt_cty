<!-- resources/views/admin/authors/many_posts.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Tác giả có từ 5 bài viết trở lên</h1>

    @if ($authors->count())
        <ul class="list-group">
            @foreach ($authors as $author)
                <li class="list-group-item">
                    {{ $author->name }} ({{ $author->posts->count() }} bài viết)
                </li>
            @endforeach
        </ul>
    @else
        <p>Không có tác giả nào có từ 5 bài viết trở lên.</p>
    @endif
@endsection
