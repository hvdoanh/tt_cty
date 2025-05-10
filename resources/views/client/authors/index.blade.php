@extends('layouts.client')

@section('content')
    <div class="container mx-auto py-10">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">
            👨‍🏫 Tác giả nổi bật (≥ 5 bài viết)
        </h2>

        @if ($authors->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($authors as $author)
                    <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="bg-blue-100 text-blue-600 rounded-full p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A11.954 11.954 0 0112 15c2.76 0 5.27.935 7.121 2.504M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $author->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $author->posts_count }} bài viết</p>
                            </div>
                        </div>

                        <a href="{{ route('client.authors.show', $author->id) }}"
                            class="inline-block mt-4 text-sm text-blue-600 font-medium hover:underline">
                            📚 Xem tất cả bài viết →
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 text-lg mt-10">
                Không có tác giả nào có từ 5 bài viết trở lên.
            </p>
        @endif
    </div>
@endsection
