@extends('layouts.client')

@section('content')
    <div class="container mx-auto px-4 py-6">
        {{-- Link quay lại --}}
        <a href="{{ route('client.posts.index') }}"
            class="inline-flex items-center text-blue-600 hover:underline text-sm mb-4">
            ← Quay lại danh sách
        </a>


        <h1 class="text-3xl font-bold text-center mb-8 text-sky-700">📰 Trang chi tiết bài viết</h1>

        {{-- Chi tiết bài viết --}}
        <article class="bg-white p-6 rounded-xl shadow-md">
            <h1 class="text-3xl font-bold text-gray-800 leading-tight">{{ $post->title }}</h1>
            <div class="text-sm text-gray-500 mt-2 flex items-center space-x-2">
                <span>✍️ {{ $post->author->name }}</span>
                <span>•</span>
                <span>🕒 {{ $post->published_at }}</span>
            </div>

            <div class="mt-6 prose max-w-none">
                {!! nl2br(e($post->content)) !!}
            </div>
        </article>

        {{-- Bài viết liên quan --}}
        @if ($relatedPosts->count())
            <section class="mt-10">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">📌 Bài viết liên quan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($relatedPosts as $related)
                        <div class="bg-white p-5 rounded-lg shadow transition hover:shadow-lg">
                            <h3 class="text-lg font-semibold text-gray-800 truncate">
                                {{ $related->title }}
                            </h3>
                            <p class="text-xs text-gray-400 mb-2">🕒 {{ $related->published_at }}</p>
                            <p class="text-sm text-gray-600 mb-3">
                                {{ Str::limit(strip_tags($related->content), 100) }}
                            </p>
                            <a href="{{ route('client.posts.show', $related->slug) }}"
                                class="inline-block text-sm text-blue-600 hover:underline font-medium">
                                Xem thêm →
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
