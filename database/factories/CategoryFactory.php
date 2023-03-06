<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word(), 
            'photo' => fake()->unique()->imageUrl(100, 100, 'categories', true), 
            'icon' =>  fake()->unique()->imageUrl(25, 25, 'icons', true),
        ];
    }
}
