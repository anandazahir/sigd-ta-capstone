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
        $roledirektur = Role::updateOrCreate(
            ['name' => 'direktur'],
            [] // No additional attributes to update
        );

        $roleinventory = Role::updateOrCreate(
            ['name' => 'inventory'],
            [] // No additional attributes to update
        );
        $roletally = Role::updateOrCreate(
            ['name' => 'tally'],
            [] // No additional attributes to update
        );

        $rolesurveyin = Role::updateOrCreate(
            ['name' => 'surveyin'],
            [] // No additional attributes to update
        );
        $rolerepair = Role::updateOrCreate(
            ['name' => 'repair'],
            [] // No additional attributes to update
        );

        $rolemops = Role::updateOrCreate(
            ['name' => 'mops'],
            [] // No additional attributes to update
        );
        $rolekasir = Role::updateOrCreate(
            ['name' => 'kasir'],
            [] // No additional attributes to update
        );

        $transaksi = Permission::updateOrCreate(
            ['name' => 'mengelola transaksi'],
            [] // No additional attributes to update
        );
        $petikemas = Permission::updateOrCreate(
            ['name' => 'mengelola petikemas'],
            [] // No additional attributes to update
        );

        $laporanharian = Permission::updateOrCreate(
            ['name' => 'membuat laporan harian'],
            [] // No additional attributes to update
        );


        $roledirektur->givePermissionTo($transaksi, $petikemas, $laporanharian);
        $roleinventory->givePermissionTo($laporanharian);

        // Assign role to user
        $user = \App\Models\User::where('username', 'direktur')->first();
        $user->assignRole('direktur');
        $user2 = \App\Models\User::where('username', 'inventory')->first();
        $user2->assignRole('inventory');
    }
}
