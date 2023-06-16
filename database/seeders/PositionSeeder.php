<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Position::create(['name' => 'KETUA EKSEKUTIF / REKTOR']);
        Position::create(['name' => 'EKSEKUTIF']);
        Position::create(['name' => 'PENOLONG EKSEKUTIF']);
        Position::create(['name' => 'PENSYARAH']);
        Position::create(['name' => 'EKSEKUTIF (KU)']);
        Position::create(['name' => 'PENOLONG EKSEKUTIF (KU)']);
        Position::create(['name' => 'PEMBANTU AM KANAN & PEMANDU']);
        Position::create(['name' => 'PELATIH']);
        Position::create(['name' => 'DEKAN']);
        Position::create(['name' => 'PENSYARAH']);
        Position::create(['name' => 'PENDAFTAR']);
    }
}
