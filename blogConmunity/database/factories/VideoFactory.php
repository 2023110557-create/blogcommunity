<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(5),
            'url' => 'https://example.com/videos/' . fake()->uuid(),
            'duration_seconds' => fake()->numberBetween(60, 1200),
        ];
    }
}