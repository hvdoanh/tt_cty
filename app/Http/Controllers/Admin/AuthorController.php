<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::latest()->paginate(10);

        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:authors',
        ]);

        Author::create($request->only('name', 'email'));

        return redirect()->route('admin.authors.index')->with('success', 'Tác giả đã được tạo.');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email,' . $author->id,
        ]);

        $author->update($request->only('name', 'email'));

        return redirect()->route('admin.authors.index')->with('success', 'Tác giả đã được cập nhật.');
    }

    public function destroy(Author $author)
    {
        $count = $author->posts()->count();
        $author->delete();

        return redirect()->route('admin.authors.index')->with('success', "Đã xoá tác giả và $count bài viết.");
    }

    public function getAuthorsWithManyPosts()
    {
        // Lấy danh sách tác giả có từ 5 bài viết trở lên
        $authors = Author::has('posts', '>=', 5)->get();


        return view('admin.authors.many_post', compact('authors'));
    }
}
