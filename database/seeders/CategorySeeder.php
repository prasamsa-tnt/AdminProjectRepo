<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
   
    
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,15) as $index) {
            DB::table('categories')->insert([
                'name' => $faker->name,
                
                
            ]);
        }
        
        
        // \App\Models\Post::factory(50)->create();
    }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

