<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_published_posts_in_last_30_days()
    {
        // Tạo dữ liệu test
        $author = Author::factory()->create();
        
        // Tạo bài viết đã publish trong 30 ngày
        $recentPost = Post::factory()->create([
            'author_id' => $author->id,
            'status' => 'published',
            'created_at' => now()->subDays(15)
        ]);

        // Tạo bài viết cũ hơn 30 ngày
        $oldPost = Post::factory()->create([
            'author_id' => $author->id,
            'status' => 'published',
            'created_at' => now()->subDays(40)
        ]);

        // Tạo bài viết draft
        $draftPost = Post::factory()->create([
            'author_id' => $author->id,
            'status' => 'draft'
        ]);

        // Kiểm tra query
        $posts = Post::published()->recent()->get();
        
        $this->assertCount(1, $posts);
        $this->assertTrue($posts->contains($recentPost));
        $this->assertFalse($posts->contains($oldPost));
        $this->assertFalse($posts->contains($draftPost));
    }

    public function test_can_get_authors_with_more_than_5_posts()
    {
        // Tạo tác giả có 6 bài viết
        $authorWithManyPosts = Author::factory()->create();
        Post::factory(6)->create(['author_id' => $authorWithManyPosts->id]);

        // Tạo tác giả có 3 bài viết
        $authorWithFewPosts = Author::factory()->create();
        Post::factory(3)->create(['author_id' => $authorWithFewPosts->id]);

        // Kiểm tra query
        $authors = Author::has('posts', '>=', 5)->get();
        
        $this->assertCount(1, $authors);
        $this->assertTrue($authors->contains($authorWithManyPosts));
        $this->assertFalse($authors->contains($authorWithFewPosts));
    }

    public function test_can_create_post_for_author()
    {
        $author = Author::factory()->create();
        
        $post = $author->posts()->create([
            'title' => 'Bài viết mới',
            'content' => 'Nội dung bài viết',
            'status' => 'draft'
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'author_id' => $author->id,
            'title' => 'Bài Viết Mới', // Kiểm tra mutator
            'slug' => 'bai-viet-moi',   // Kiểm tra mutator
            'status' => 'draft'
        ]);
    }

    public function test_can_update_post_by_slug()
    {
        $author = \App\Models\Author::factory()->create();
        $post = \App\Models\Post::factory()->create([
            'author_id' => $author->id,
            'status' => 'draft',
            'content' => 'Nội dung cũ'
        ]);

        $post->update([
            'content' => 'Nội dung mới',
            'status' => 'published'
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'content' => 'Nội dung mới',
            'status' => 'published'
        ]);
    }

    public function test_cascade_delete_author_posts()
    {
        $author = Author::factory()->create();
        $posts = Post::factory(3)->create(['author_id' => $author->id]);

        $postCount = Post::count();
        $this->assertEquals(3, $postCount);

        $author->delete();

        $this->assertEquals(0, Post::count());
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}
