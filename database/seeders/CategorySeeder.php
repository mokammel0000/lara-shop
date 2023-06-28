<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Category::truncate();

        // Category::factory(5)->create();
        Category::factory()->count(7)->create();

    }
}
