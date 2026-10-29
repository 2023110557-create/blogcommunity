<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'bio' => fake()->sentence(10),
            'avatar' => fake()->imageUrl(200, 200, 'people'),
            'website' => fake()->url(),
            'twitter' => '@' . fake()->userName(),
        ];
    }
}