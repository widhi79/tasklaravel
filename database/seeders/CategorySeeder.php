<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Seed categories with sample data
        Category::create(['name' => 'Category 1']);
        Category::create(['name' => 'Category 2']);
    }
}
