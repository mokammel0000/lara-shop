<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Photoseeder extends Seeder
{
    public function run(): void
    {
        // Photo::truncate();

        Photo::factory()->count(999)->create();
    }
}
