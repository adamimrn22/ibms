<?php

namespace Database\Seeders;

use App\Models\UkwBooking;
use App\Models\UkwInventory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UkwInventorySeeder extends Seeder
{
    // TERSILAP NAMA MALAS TUKAR NGAHAHAH NI UNTUK ukw_booking_inventories_table


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = UkwBooking::all();

        $bookings->each(function ($booking) {
            // Create a UkwInventory instance using the factory
            $inventory = UkwInventory::all();

            // Attach the UkwInventory to the booking with pivot data
            $booking->inventories()->attach($inventory, [
                'quantity' => 10,
                'approved_quantity' => 5,
                'remarkNotes' => 'Some notes',
                'status_id' => 1,
            ]);
        });
    }
}
