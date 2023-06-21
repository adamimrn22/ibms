<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UnitSeeder::class);
        $this->call(PositionSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        // $this->call(PermissionSeeder::class);

        // $role = Role::findByName('User');


        User::factory(50)->create()->each(function ($user) use ($role) {
            $user->assignRole($role);
        });
    }
}
