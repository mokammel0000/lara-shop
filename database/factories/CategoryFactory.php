<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->word(), 
            'photo' => fake()->unique()->imageUrl(100, 100, 'categories', true), 
            'icon' =>  fake()->unique()->imageUrl(20, 20, 'icons', true),
        ];
    }
}
