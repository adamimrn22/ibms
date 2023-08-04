<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
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
        $statusBooking = ['PENDING', 'APPROVED', 'REJECTED'];
        $statusUIT = ['AVAILABLE', 'BOOKED', 'MISSING', 'DISPOSE', 'DAMAGED'];
        $statusCable = ['AVAILABLE', 'PLUGGED', 'MISSING', 'DISPOSE', 'DAMAGED'];
        $statusUPSM = ['AVAILABLE', 'RENOVATE', 'EVENT'];
        $statusUKW = ['AVAILABLE', 'DISABLE', 'OUT OF STOCK'];
        $statusKenderaan = ['AVAILABLE', 'UNAVAILABLE', 'SERVICE'];

        foreach ($statusUIT as $status) {
            Status::create([
                'name' => $status,
                'category_id' => 1
            ]);
        }

        foreach ($statusBooking as $status) {
            BookingStatus::create([
                'name' => $status
            ]);
        }

        foreach ($statusUPSM as $status) {
            Status::create([
                'name' => $status,
                'category_id' => 5
            ]);
        }

        foreach ($statusUKW as $status) {
            Status::create([
                'name' => $status,
                'category_id' => 7
            ]);
        }

        foreach ($statusKenderaan as $status) {
            Status::create([
                'name' => $status,
                'category_id' => 6
            ]);
        }
        foreach ($statusCable as $status) {
            Status::create([
                'name' => $status,
                'category_id' => 2
            ]);
        }
    }
}
