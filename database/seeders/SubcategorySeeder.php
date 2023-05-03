<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;
class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('subcategories')->insert([
            [
                'name'          => 'Laravel Master Class',
                'category_id'   => 1
            ],
            [
                'name'          => 'Laravel for Beginners',
                'category_id'   => 1
            ],
            [
                'name'          => 'CodeIgniter 4: Build a Complete Web Application from Scratch',
                'category_id'   => 1
            ],
            [
                'name'          => 'The Modern JavaScript Bootcamp',
                'category_id'   => 2
            ],
            [
                'name'          => 'JavaScript: The Advanced Concepts (2021)',
                'category_id'   => 2
            ],
            [
                'name'          => 'Learning Alpine.JS',
                'category_id'   => 3
            ],
            [
                'name'          => 'Start with TALL: Use Tailwind, Alpine, Laravel & Livewire',
                'category_id'   => 3
            ],
        ]);
       
       
    }
}
