@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Danh sách bài viết</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Tạo bài viết mới</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Slug</th>
                            <th>tác giả</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->author->name }}</td>
                                <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-info">SHow</a>
                                    <a href="{{ route('admin.posts.edit.slug', $post) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{-- Phân trang đẹp hơn với Bootstrap --}}
                <nav>
                    <ul class="pagination justify-content-center">
                        {{-- Previous --}}
                        <li class="page-item {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $posts->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Pagination Numbers --}}
                        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $posts->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next --}}
                        <li class="page-item {{ $posts->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $posts->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
