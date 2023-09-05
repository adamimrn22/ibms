<?php

namespace Database\Seeders;

use App\Models\UkwBooking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UkwBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UkwBooking::factory()->count(20)->create();
    }
}
