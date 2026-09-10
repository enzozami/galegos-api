<?php

namespace Database\Seeders;

use Gal\Models\Category\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Marmitas'],
            ['name' => 'Lanches'],
            ['name' => 'Bebidas'],
            ['name' => 'Saladas'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
