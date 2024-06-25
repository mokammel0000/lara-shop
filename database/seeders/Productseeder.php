<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Productseeder extends Seeder
{
    public function run(): void
    {
        // product::truncate();

        product::factory()->count(98)->create();
    }
}
