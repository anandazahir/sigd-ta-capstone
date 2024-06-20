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
                'pendidikan_terakhir' => 'S2',
                'tanggal_lahir' => '1975-05-15', // Use appropriate date format
                'status_menikah' => 'Menikah'
            ]
        );

        // New random accounts
        User::updateOrCreate(
            ['username' => 'tally'],
            [
                'email' => 'tally@example.com',
                'password' => Hash::make('password123'),
                'nip' => '123456780',
                'nik' => '123456780',
                'nama' => 'Tally User',
                'no_hp' => '081234567892',
                'jabatan' => 'Tally',
                'alamat' => 'Jl. Tally No. 789',
                'agama' => 'Islam',
                'foto' => null,
                'JK' => 'Laki - Laki',
                'pendidikan_terakhir' => 'S1',
                'tanggal_lahir' => '1990-02-01',
                'status_menikah' => 'Single'
            ]
        );

        User::updateOrCreate(
            ['username' => 'kasir'],
            [
                'email' => 'kasir@example.com',
                'password' => Hash::make('password123'),
                'nip' => '123456781',
                'nik' => '123456781',
                'nama' => 'Kasir User',
                'no_hp' => '081234567893',
                'jabatan' => 'Kasir',
                'alamat' => 'Jl. Kasir No. 456',
                'agama' => 'Islam',
                'foto' => null,
                'JK' => 'Perempuan',
                'pendidikan_terakhir' => 'S1',
                'tanggal_lahir' => '1985-03-10',
                'status_menikah' => 'Single'
            ]
        );

        User::updateOrCreate(
            ['username' => 'survey_in'],
            [
                'email' => 'surveyin@example.com',
                'password' => Hash::make('password123'),
                'nip' => '123456782',
                'nik' => '123456782',
                'nama' => 'Survey In User',
                'no_hp' => '081234567894',
                'jabatan' => 'Survey In',
                'alamat' => 'Jl. Survey In No. 123',
                'agama' => 'Islam',
                'foto' => null,
                'JK' => 'Laki - Laki',
                'pendidikan_terakhir' => 'S1',
                'tanggal_lahir' => '1988-04-20',
                'status_menikah' => 'Menikah'
            ]
        );

        User::updateOrCreate(
            ['username' => 'manajer_ops'],
            [
                'email' => 'manajerops@example.com',
                'password' => Hash::make('password123'),
                'nip' => '123456783',
                'nik' => '123456783',
                'nama' => 'Manajer Operasional User',
                'no_hp' => '081234567895',
                'jabatan' => 'Manajer Operasional',
                'alamat' => 'Jl. Manajer Ops No. 456',
                'agama' => 'Islam',
                'foto' => null,
                'JK' => 'Laki - Laki',
                'pendidikan_terakhir' => 'S2',
                'tanggal_lahir' => '1982-05-25',
                'status_menikah' => 'Menikah'
            ]
        );

        User::updateOrCreate(
            ['username' => 'repair'],
            [
                'email' => 'repair@example.com',
                'password' => Hash::make('password123'),
                'nip' => '123456784',
                'nik' => '123456784',
                'nama' => 'Repair User',
                'no_hp' => '081234567896',
                'jabatan' => 'Repair',
                'alamat' => 'Jl. Repair No. 789',
                'agama' => 'Islam',
                'foto' => null,
                'JK' => 'Laki - Laki',
                'pendidikan_terakhir' => 'S1',
                'tanggal_lahir' => '1986-06-15',
                'status_menikah' => 'Single'
            ]
        );
    }
}
