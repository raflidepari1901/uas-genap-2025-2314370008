<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('articles')->insert([
            [
                'title' => 'The Future of AI',
                'content' => 'Artificial Intelligence is transforming the world...',
                'slug' => Str::slug('The Future of AI'),
                'category_id' => 1,
                'is_publish' => true,
                'published_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Staying Healthy in 2025',
                'content' => 'Health is wealth, especially in a fast-paced world...',
                'slug' => Str::slug('Staying Healthy in 2025'),
                'category_id' => 2,
                'is_publish' => false,
                'published_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}

