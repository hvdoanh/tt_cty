<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'author_id'     => $request->author_id, // hoặc auth()->id() nếu là tác giả đăng nhập
            'title'         => $request->title,
            'slug'          => \Illuminate\Support\Str::slug($request->title),
            'content'       => $request->content,
            'status'        => $request->status ?? 'draft',
            'published_at'  => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Bài viết đã được tạo thành công');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function listForUsers()
    {
        $posts = Post::with('author')
            ->published()
            ->recent()
            ->latest()
            ->paginate(6); // số bài mỗi trang

        return view('client.posts.index', compact('posts'));
    }
    // app/Http/Controllers/PostController.php

    public function showDetail($slug)
    {
        $post = Post::with('author')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('author_id', $post->author_id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('client.posts.show', compact('post', 'relatedPosts'));
    }

    public function editBySlug($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.edit', compact('post'));
    }



    public function update(Request $request, $slug)
    {
        // Tìm bài viết theo slug
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return redirect()->route('admin.posts.index')->with('error', 'Bài viết không tồn tại!');
        }

        // Xử lý validate và cập nhật bài viết
        $request->validate([
            'content' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        // Cập nhật bài viết
        $post->update([
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Bài viết đã được cập nhật!');
    }
}
