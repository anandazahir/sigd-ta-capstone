<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::updateOrCreate(
            ['name' => 'direktur'],
            [] // No additional attributes to update
        );

        $roleUser = Role::updateOrCreate(
            ['name' => 'inventory'],
            [] // No additional attributes to update
        );

        $cantransaksi = Permission::updateOrCreate(
            ['name' => 'mengelola transaksi'],
            [] // No additional attributes to update
        );
        $canpetikemas = Permission::updateOrCreate(
            ['name' => 'mengelola petikemas'],
            [] // No additional attributes to update
        );

        $permissionUser = Permission::updateOrCreate(
            ['name' => 'membuat laporan harian'],
            [] // No additional attributes to update
        );


        $roleAdmin->givePermissionTo($cantransaksi, $canpetikemas, $permissionUser);
        $roleUser->givePermissionTo($permissionUser);

        // Assign role to user
        $user = \App\Models\User::where('username', 'direktur')->first();
        $user->assignRole('direktur');
        $user2 = \App\Models\User::where('username', 'inventory')->first();
        $user2->assignRole('inventory');
    }
}
