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
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
            ] // Attributes to update if found, or create if not found
        );

        User::updateOrCreate(
            ['username' => 'direktur'], // Attributes to search for
            [
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
            ] // Attributes to update if found, or create if not found
        );
    }
}
