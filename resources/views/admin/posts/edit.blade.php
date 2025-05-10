@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto mt-20 px-6">
        <div class="bg-white shadow-xl rounded-2xl border border-gray-100 p-8">
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center gap-2">
                    ✏️ Chỉnh sửa bài viết
                </h1>
                <p class="text-gray-500 text-sm">Cập nhật nội dung và trạng thái bên dưới.</p>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.posts.update.slug', $post->slug) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Content --}}
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">📝 Nội dung</label>
                    <textarea id="content" name="content" rows="12"
                        class="w-full bg-gray-50 border border-gray-300 rounded-xl px-5 py-4 text-sm text-gray-800 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-y transition">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">📌 Trạng thái</label>
                    <select id="status" name="status"
                        class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm text-gray-800 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="draft" {{ $post->status === 'draft' ? 'selected' : '' }}>🗂 Nháp</option>
                        <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>🌐 Công khai
                        </option>
                    </select>
                    @error('status')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex justify-end">
                    <button type="submit">

                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
