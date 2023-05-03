<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,50) as $index) {
            DB::table('blogs')->insert([
                'name' => $faker->name,
                'author_id' =>1,
                'category_id' =>1,
                // 'phone' => $faker->phoneNumber,
            ]);
        }
        
        $this->call([
            StudentSeeder::class,
            
            
        ]);
        // $this->call([
        //     CategorySeeder::class,
            
        //     SubcategorySeeder::class,

        //     AdminSeeder::class
        // ]);

        // \App\Models\Post::factory(50)->create();
    }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

