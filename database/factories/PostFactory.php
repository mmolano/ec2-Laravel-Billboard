<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(2);

        return [
            'title' => rtrim($title, '.'),
            'content' => fake()->text(),
            'user_id' => User::inRandomOrder()->first()->user_id,
        ];
    }
}
