<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Tạo 10 tác giả
        // $authors = Author::factory(10)->create();

        // // Mỗi tác giả có 3-7 bài viết
        // $authors->each(function ($author) {
        //     Post::factory(rand(3, 7))->create([
        //         'author_id' => $author->id
        //     ]);
        // });


        // Tạo Users (30): 10 teacher + 20 student
        $teachers = User::factory(10)->create(['role' => 'teacher']);
        $students = User::factory(20)->create(['role' => 'student']);

        // Tạo Profile cho mỗi User
        User::all()->each(fn($user) => $user->profile()->create(Profile::factory()->make()->toArray()));

        // Tạo Tags
        $tags = Tag::factory(10)->create();

        // Tạo Course và Lesson cho mỗi Teacher
        $teachers->each(function ($teacher) use ($tags, $students) {
            $courses = Course::factory(3)->make();
            $teacher->courses()->saveMany($courses);

            $courses->each(function ($course) use ($tags, $students) {
                $lessons = Lesson::factory(rand(5, 8))->make();
                $course->lessons()->saveMany($lessons);

                $lessons->each(function ($lesson) use ($tags, $students, $course) {
                    // Gán tag ngẫu nhiên
                    $lesson->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());

                    // Comment trên bài học
                    $students->random(3)->each(function ($student) use ($lesson) {
                        $lesson->comments()->create([
                            'user_id' => $student->id,
                            'content' => fake()->sentence
                        ]);
                    });

                    // Comment trên khóa học
                    $students->random(2)->each(function ($student) use ($course) {
                        $course->comments()->create([
                            'user_id' => $student->id,
                            'content' => fake()->sentence
                        ]);
                    });
                });
            });
        });
    }
}
