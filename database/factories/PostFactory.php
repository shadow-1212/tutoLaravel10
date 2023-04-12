<?php

namespace Database\Factories;

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
        return [
            //make a factory for the posts table
            //define the fields that the factory should fill
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraph,
        ];
    }
}
