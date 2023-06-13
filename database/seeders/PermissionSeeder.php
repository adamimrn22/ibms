<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'user.add']);
        Permission::create(['name' => 'user.view']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'user.softdelete']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'it-inventory.add']);
    }
}
