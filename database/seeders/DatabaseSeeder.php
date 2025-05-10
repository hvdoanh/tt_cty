<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Tạo 10 tác giả
        $authors = Author::factory(10)->create();

        // Mỗi tác giả có 3-7 bài viết
        $authors->each(function ($author) {
            Post::factory(rand(3, 7))->create([
                'author_id' => $author->id
            ]);
        });
    }
}
