<?php

namespace Database\Seeders;

use Gal\Models\Category\Category;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marmita = Category::where('name', 'Marmitas')->first();

        $subCategories = [
            ['name' => 'Mini', 'category_id' => $marmita->id],
            ['name' => 'Média', 'category_id' => $marmita->id]
        ];
    }
}


