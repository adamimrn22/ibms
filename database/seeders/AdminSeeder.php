<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'ADMIN UIT',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'isActive' => true,
            'phone_number' => '111',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('Admin IT');

        User::create([
            'name' => 'ADMIN HR',
            'username' => 'adminHR',
            'email' => 'adminHR@admin.com',
            'email_verified_at' => now(),
            'isActive' => true,
            'phone_number' => '111',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('Admin HR');

        User::create([
            'name' => 'ADMIN UKW',
            'username' => 'adminUKW',
            'email' => 'adminUKW@admin.com',
            'email_verified_at' => now(),
            'isActive' => true,
            'phone_number' => '111',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('Admin UKW');

        User::create([
            'name' => 'adam imran',
            'username' => 'SysDev',
            'email' => 'adam@kolejspace.edu.my',
            'email_verified_at' => now(),
            'isActive' => true,
            'phone_number' => '111',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('Super Admin');

        User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'isActive' => true,
            'phone_number' => '111',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('User');


    }
}