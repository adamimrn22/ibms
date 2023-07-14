<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category_name' => 'Hardware',
            'unit_id' => '1'
        ]);

        Category::create([
            'category_name' => 'Cable',
            'unit_id' => '1'
        ]);
        Category::create([
            'category_name' => 'Others',
            'unit_id' => '1'
        ]);
        Category::create([
            'category_name' => 'Ruang Pejabat',
            'unit_id' => '5'
        ]);
        Category::create([
            'category_name' => 'Ruang Kelas',
            'unit_id' => '5'
        ]);

        Category::create([
            'category_name' => 'Alat Tulis',
            'unit_id' => '3'
        ]);

    }
}
