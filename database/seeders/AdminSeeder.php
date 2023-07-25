<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\User;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $unitId = Unit::inRandomOrder()->first()->id;
        $positionId = Position::inRandomOrder()->first()->id;

        // User::create([
        //     'first_name' => 'ADMIN',
        //     'last_name' => 'UIT',
        //     'username' => 'admin',
        //     'email' => 'admin@admin.com',
        //     'email_verified_at' => now(),
        //     'isActive' => true,
        //     'phone_number' => '111',
        //     'unit_id' => $unitId,
        //     'position_id' => $positionId,
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ])->assignRole('Admin IT');

        // User::create([
        //     'first_name' => 'ADMIN',
        //     'last_name' => 'UPSM',
        //     'username' => 'adminUPSM',
        //     'email' => 'adminUPSM@admin.com',
        //     'email_verified_at' => now(),
        //     'isActive' => true,
        //     'phone_number' => '111',
        //     'unit_id' => $unitId,
        //     'position_id' => $positionId,
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ])->assignRole('Admin HR');

        User::create([
            'first_name' => 'ADMIN',
            'last_name' => 'UKW',
            'username' => 'adminUKW',
            'email' => 'adminUKW@admin.com',
            'email_verified_at' => now(),
            'isActive' => true,
            'unit_id' => $unitId,
            'position_id' => $positionId,
            'phone_number' => '111',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('Admin UKW');

       $superAdmin = User::create([
            'first_name' => 'System',
            'last_name' => 'Developer',
            'username' => 'SysDev',
            'email' => 'adam@kolejspace.edu.my',
            'email_verified_at' => now(),
            'isActive' => true,
            'unit_id' => $unitId,
            'position_id' => $positionId,
            'phone_number' => '111',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('Super Admin');

        // Assign the 'Super Admin' role to the super admin user
        $superAdmin->assignRole('Super Admin');

        // Get the permissions for the 'Super Admin' role
        $superAdminPermissions = Role::findByName('Super Admin')->permissions;

        // Sync the permissions for the super admin user
        $superAdmin->syncPermissions($superAdminPermissions);


        // User::create([
        //     'first_name' => 'user',
        //     'last_name' => 'first',
        //     'username' => 'user',
        //     'email' => 'user@user.com',
        //     'email_verified_at' => now(),
        //     'isActive' => true,
        //     'unit_id' => $unitId,
        //     'position_id' => $positionId,
        //     'phone_number' => '111',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ])->assignRole('User');


    }
}
