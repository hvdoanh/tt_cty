@extends('layouts.client') {{-- layout dành cho người dùng thường --}}

@section('title', 'Bài viết mới nhất')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-sky-700">📰 Bài viết mới nhất</h1>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all p-5">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ $post->title }}
                    </h2>

                    <div class="text-sm text-gray-500 mb-2 flex flex-wrap gap-2 items-center">
                        ✍️ <span>{{ $post->author->name ?? 'Ẩn danh' }}</span>
                        •
                        🗓 <time>{{ $post->created_at->format('d/m/Y H:i') }}</time>
                    </div>

                    <p class="text-gray-600 mb-4">
                        {{ Str::limit($post->content, 120) }}
                    </p>

                    <a href="{{ route('client.posts.show', $post->slug) }}" class="text-blue-600 font-medium hover:underline">
                        Xem chi tiết →
                    </a>
                </article>
            @endforeach
        </div>




        <div class="mt-8">
            {{ $posts->links() }}
        </div>


        <h1 class="text-3xl font-bold text-center mb-8 text-sky-700"><a href="{{ route('client.authors.index') }}">Danh sách
                tác giả có 5 bài viết ↑</a></h1>

    </section>
@endsection
