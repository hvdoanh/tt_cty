<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence();
        $status = fake()->randomElement(['draft', 'published', 'archived']);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraphs(3, true),
            'status' => $status,
            'published_at' => $status === 'published' ? fake()->dateTimeBetween('-1 year') : null,
        ];
    }
} 