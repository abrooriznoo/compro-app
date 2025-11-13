<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'description' => 'All about the latest in tech.'],
            ['name' => 'Health', 'description' => 'Health tips and news.'],
            ['name' => 'Travel', 'description' => 'Travel guides and experiences.'],
            ['name' => 'Food', 'description' => 'Delicious recipes and food reviews.'],
            ['name' => 'Education', 'description' => 'Learning resources and articles.'],
        ];

        foreach ($categories as $key => $value) {
            Categories::create([
                'name' => $value['name'],
                'description' => $value['description'],
                'slug' => Str::slug($value['name']),
            ]);
        }
    }

}
