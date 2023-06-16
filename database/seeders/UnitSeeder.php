<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create(['name' => 'PEMBANGUNAN SISTEM']);
        Unit::create(['name' => 'PEMBANGUNAN BISNES']);
        Unit::create(['name' => 'KEWANGAN']);
        Unit::create(['name' => 'HAL EHWAL PELAJAR']);
        Unit::create(['name' => 'PENTADBIRAN DAN SUMBER MANUSIA']);
        Unit::create(['name' => 'UNIT PENTABIRAN AKADEMIK']);
        Unit::create(['name' => 'PEJABAT REKTOR']);
        Unit::create(['name' => 'AKADEMIK']);
        Unit::create(['name' => 'UNIT KUALITI & AKREDITASI']);
        Unit::create(['name' => 'UNIT PEMBANGUNAN AKADEMIK (CADe)']);
    }
}
