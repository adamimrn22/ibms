<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create([
            'subcategory_name' => 'Laptop',
            'category_id' => '1'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Desktop',
            'category_id' => '1'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Mouse',
            'category_id' => '1'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Keyboard',
            'category_id' => '1'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Bilik',
            'category_id' => '7'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Pejabat',
            'category_id' => '6'
        ]);

        SubCategory::create([
            'subcategory_name' => 'File',
            'category_id' => '8'
        ]);

        SubCategory::create([
            'subcategory_name' => 'PAPER',
            'category_id' => '8'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Stationery',
            'category_id' => '8'
        ]);


    }
}
