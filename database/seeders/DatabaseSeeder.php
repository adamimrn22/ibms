<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UpsmRuangBooking;
use App\Models\UpsmRuangBookingDetails;
use Database\Factories\ruangBookingFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UnitSeeder::class);
        // $this->call(PositionSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(SubCategorySeeder::class);
        // $this->call(StatusSeeder::class);

        // $this->call(RoleSeeder::class);
        // $this->call(AdminSeeder::class);
        // $this->call(PermissionSeeder::class);

        UpsmRuangBooking::factory(50)->create()->each(function ($booking) {
            $booking->detail()->save(UpsmRuangBookingDetails::factory()->make());
        });
        // $role = Role::findByName('User');


        // User::factory(50)->create()->each(function ($user) use ($role) {
        //     $user->assignRole($role);
        // });
    }
}
