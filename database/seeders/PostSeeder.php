<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //make a seeder for the posts table
        //use the factory to create 10 posts
        \App\Models\Post::factory(10)->create();
    }
}
