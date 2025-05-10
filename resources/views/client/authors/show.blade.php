@extends('layouts.client')

@section('content')
    <div class="container mx-auto py-10">
        <a href="{{ route('client.authors.index') }}" class="inline-block text-blue-600 hover:underline mb-6">
            ← Quay lại danh sách tác giả
        </a>

        {{-- Thông tin tác giả --}}
        <div class="bg-white p-6 rounded-xl shadow-md mb-8">
            <h2 class="text-3xl font-bold text-gray-800">{{ $author->name }}</h2>
            <p class="text-gray-600 mt-2">
                ✍️ <span class="font-medium">Tổng số bài viết:</span> {{ $author->posts->count() }}
            </p>
        </div>

        {{-- Danh sách bài viết --}}
        <div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">
                📚 Bài viết của {{ $author->name }}
            </h3>

            @if ($author->posts->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($author->posts as $post)
                        <div class="bg-white p-5 rounded-lg shadow hover:shadow-lg transition duration-300">
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">
                                {{ $post->title }}
                            </h4>
                            <p class="text-sm text-gray-500 mb-3">
                                🕒 {{ \Carbon\Carbon::parse($post->published_at)->format('d/m/Y') }}
                            </p>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>
                            <a href="{{ route('client.posts.show', $post->slug) }}"
                                class="text-blue-600 hover:underline text-sm font-medium">
                                Xem chi tiết →
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-lg text-center mt-10">
                    Tác giả này chưa có bài viết nào.
                </p>
            @endif
        </div>
    </div>
@endsection
