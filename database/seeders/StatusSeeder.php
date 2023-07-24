<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\UitInventory;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusUIT = ['AVAILABLE', 'BOOKED', 'MISSING', 'DISPOSE', 'DAMAGED'];
        $statusUPSM = ['AVAILABLE', 'RENOVATE', 'EVENT'];

        foreach ($statusUIT as $status) {
            Status::create([
                'name' => $status,
                'category_id' => 1
            ]);
        }

        foreach ($statusUPSM as $status) {
            Status::create([
                'name' => $status,
                'category_id' => 5
            ]);
        }
    }
}
