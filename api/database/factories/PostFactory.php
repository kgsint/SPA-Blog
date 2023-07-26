<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
    public function definition(): array
    {
        $title = str_replace('.', '', $this->faker->sentence(4));
        $body = $this->faker->paragraph();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => substr($body, 0, 150),
            'user_id' => rand(1,5),
            'body' => $body,
        ];
    }
}
