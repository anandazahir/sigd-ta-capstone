<?php

namespace Database\Seeders;

use App\Models\petikemas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetikemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $petikemas = [
        "benline" => ["code" => "BEN"],
        "wanhai"  => ["code" => "WAN"],
        "one"     => ["code" => "ONE"]
    ];

    for ($i = 1; $i < 10; $i++) {
        $randomarray = array_rand($petikemas);
        petikemas::updateOrCreate(
            ['no_petikemas' => $petikemas[$randomarray]['code'] . ' ' . rand(111111, 999999)], // Attributes to search for
            [
                'jenis_ukuran' => "20'FT",
                'pelayaran' => $randomarray, // Convert array to JSON string
                'tanggal_masuk' => now(),
                'harga' => 255000,
                'status_order' => 'true',
                'lokasi' => 'pending',
                'status_kondisi' => 'available',
                'status_ketersediaan' => 'in'
            ]
        );
    }

    for ($i = 10; $i < 20; $i++) {
        $randomarray = array_rand($petikemas);
        petikemas::updateOrCreate(
            ['no_petikemas' => $petikemas[$randomarray]['code'] . ' ' . rand(111111, 999999)], // Attributes to search for
            [
                'jenis_ukuran' => "20'FT",
                'pelayaran' => $randomarray, // Convert array to JSON string
                'tanggal_masuk' => now(),
                'harga' => 255000,
                'status_order' => 'true',
                'lokasi' => 'out',
                'status_kondisi' => 'available',
                'status_ketersediaan' => 'out'
            ]
        );
    }
}

}
