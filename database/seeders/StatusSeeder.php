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
        $status = ['AVAILABLE', 'BOOKED', 'MISSING', 'DISPOSE', 'DAMAGED'];

        foreach ($status as $status) {
            Status::create([
                'name' => $status,
                'category_id' => 1
            ]);
        }
    }
}
