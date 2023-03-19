<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class PhotoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(), 
            'path' => fake()->unique()->imageUrl(640, 480, 'photo', true), 
            'product_id' =>  fake()->randomNumber(2, true),
        ];
    }
}
