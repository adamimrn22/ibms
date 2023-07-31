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
            'subcategory_name' => 'Desktop',
            'category_id' => '1'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Laptop',
            'category_id' => '1'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Monitor',
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
            'subcategory_name' => 'Printer',
            'category_id' => '1'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Projector',
            'category_id' => '1'
        ]);

        SubCategory::create([
            'subcategory_name' => 'HDMI',
            'category_id' => '2'
        ]);

        SubCategory::create([
            'subcategory_name' => 'VGA',
            'category_id' => '2'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Ethernet',
            'category_id' => '2'
        ]);

        SubCategory::create([
            'subcategory_name' => 'DVI',
            'category_id' => '2'
        ]);

        SubCategory::create([
            'subcategory_name' => 'USB',
            'category_id' => '2'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Software',
            'category_id' => '3'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Miscellaneous',
            'category_id' => '3'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Pejabat',
            'category_id' => '4'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Bilik',
            'category_id' => '5'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Kereta',
            'category_id' => '6'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Paper',
            'category_id' => '7'
        ]);

        SubCategory::create([
            'subcategory_name' => 'File',
            'category_id' => '7'
        ]);

        SubCategory::create([
            'subcategory_name' => 'Stationery',
            'category_id' => '7'
        ]);



    }
}
