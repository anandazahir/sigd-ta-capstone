<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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

        $melihat_petikemas = Permission::updateOrCreate(
            ['name' => 'melihat petikemas'],
            [] // No additional attributes to update
        );

        $laporanharian = Permission::updateOrCreate(
            ['name' => 'membuat laporan harian'],
            [] // No additional attributes to update
        );

        $melihat_pengecekan = Permission::updateOrCreate(
            ['name' => 'melihat pengecekan'],
            [] // No additional attributes to update
        );

        $melihat_transaksi = Permission::updateOrCreate(
            ['name' => 'melihat transaksi'],
            [] // No additional attributes to update
        );

        $melihat_perbaikan = Permission::updateOrCreate(
            ['name' => 'melihat perbaikan'],
            [] // No additional attributes to update
        );

        $melihat_riwayatperbaikan = Permission::updateOrCreate(
            ['name' => 'melihat riwayat perbaikan'],
            [] // No additional attributes to update
        );

        $melihat_riwayatpenempatan = Permission::updateOrCreate(
            ['name' => 'melihat riwayat penempatan'],
            [] // No additional attributes to update
        );
        $mengelola_penempatan = Permission::updateOrCreate(
            ['name' => 'mengelola penempatan'],
            [] // No additional attributes to update
        );
        $mengelola_perbaikan = Permission::updateOrCreate(
            ['name' => 'mengelola perbaikan'],
            [] // No additional attributes to update
        );

        $melihat_pembayaran = Permission::updateOrCreate(
            ['name' => 'melihat pembayaran'],
            [] // No additional attributes to update
        );
        $roledirektur->givePermissionTo($transaksi, $petikemas, $melihat_petikemas, $laporanharian, $melihat_transaksi, $melihat_riwayatperbaikan, $melihat_riwayatpenempatan);
        $rolemops->givePermissionTo($transaksi, $petikemas, $melihat_petikemas, $laporanharian, $melihat_transaksi, $melihat_riwayatperbaikan, $melihat_riwayatpenempatan);
        $roleinventory->givePermissionTo($laporanharian, $melihat_transaksi, $melihat_petikemas, $melihat_riwayatperbaikan, $melihat_riwayatpenempatan);
        $rolesurveyin->givePermissionTo($melihat_pengecekan);
        $rolerepair->givePermissionTo($melihat_petikemas, $melihat_perbaikan, $melihat_riwayatperbaikan, $mengelola_perbaikan);
        $roletally->givePermissionTo($mengelola_penempatan, $melihat_riwayatpenempatan, $melihat_petikemas);
        $rolekasir->givePermissionTo($melihat_pembayaran);
        // Assign role to user
        $direktur = User::where('username', 'direktur')->first();
        $direktur->assignRole('direktur');
        $inventory = User::where('username', 'inventory')->first();
        $inventory->assignRole('inventory');
        $repair = User::where('username', 'repair')->first();
        $repair->assignRole('repair');
        $kasir = User::where('username', 'kasir')->first();
        $kasir->assignRole('kasir');
        $manajer_ops = User::where('username', 'manajer_ops')->first();
        $manajer_ops->assignRole('mops');
        $survey_in = User::where('username', 'survey_in')->first();
        $survey_in->assignRole('surveyin');
        $tally = User::where('username', 'tally')->first();
        $tally->assignRole('tally');
    }
}
