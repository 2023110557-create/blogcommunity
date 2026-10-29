<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->randomNumber(5),
            'excerpt' => fake()->sentence(15),
            'body' => fake()->paragraphs(5, true),
            'cover_image' => fake()->imageUrl(800, 400),
            'status' => 'published',
            'published_at' => now(),
        ];
    }
}