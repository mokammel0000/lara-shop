<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{ 
    public function definition(): array
    {
        return [
            'name' => fake()->word(), 
            'sku' =>  fake()->randomNumber(4, true),
            'description' =>  fake()->paragraph(),
            'price' =>  fake()->randomFloat(2, 20, 40000),
            'stock' =>  fake()->randomNumber(5, false),
            'category_id' =>  fake()->randomNumber(1, true),
        ];
    }
}
