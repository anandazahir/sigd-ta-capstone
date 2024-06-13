<?php

// database/seeders/UsersTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['username' => 'inventory'], // Attributes to search for
            [
                'email' => 'user1@example.com',
                'password' => Hash::make('password123'),
                'nip' => '123456789',
                'nama' => 'Rizal Firdaus',
                'nik' => '123456789',
                'no_hp' => '081234567890',
                'jabatan' => 'inventory',
                'alamat' => 'Jl. Admin Inventory No. 123',
                'agama' => 'Islam',
                'foto' => null, // or 'path/to/photo.jpg' if available
                'JK' => 'Laki - Laki', // Assuming 'L' for male and 'P' for female
                'pendidikan_terakhir' => 'S1',
                'tanggal_lahir' => '1980-01-01', // Use appropriate date format
                'status_menikah' => 'Menikah'
            ]
        );

        User::updateOrCreate(
            ['username' => 'direktur'], // Attributes to search for
            [
                'email' => 'admin1@example.com',
                'password' => Hash::make('password123'),
                'nip' => '987654321',
                'nik' => '987654321',
                'nama' => 'Ananda Zahir',
                'no_hp' => '081234567891',
                'jabatan' => 'Direktur',
                'alamat' => 'Jl. Direktur Utama No. 456',
                'agama' => 'Kristen',
                'foto' => null, // or 'path/to/photo.jpg' if available
                'JK' => 'Perempuan', // Assuming 'L' for male and 'P' for female
                'pendidikan_terakhir' => 'S2 ',
                'tanggal_lahir' => '1975-05-15', // Use appropriate date format
                'status_menikah' => 'Menikah'
            ]
        );
    }
}
