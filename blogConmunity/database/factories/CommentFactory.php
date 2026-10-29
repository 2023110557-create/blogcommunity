<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'body' => fake()->sentence(12),
            'approved' => true,
            // commentable_id / commentable_type se asignan en el seeder
        ];
    }
}