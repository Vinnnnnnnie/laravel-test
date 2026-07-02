<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // User::factory()->count(10)->create();
        $directory = public_path('storage/users');
        $scanned_directory = array_diff(scandir($directory), ['..', '.']);
        User::factory()->create()->count(10);
        User::create([
            'username' => 'Vinnie',
            'first_name' => 'Vincent',
            'last_name' => 'Owens',
            'email' => 'vincent@gmail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
            'reputation' => 1000,
        ]);
        User::create([
            'username' => 'Rise',
            'first_name' => 'Tom',
            'last_name' => 'Bozier',
            'email' => 'tom@gmail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
            'reputation' => 1000,
        ]);
        User::create([
            'username' => 'FinalNightOfSin',
            'first_name' => 'Ellen',
            'last_name' => 'Maxwell',
            'email' => 'ellen@gmail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
            'reputation' => 1000,

        ]);
        User::create(
            [
                'username' => 'Midnight',
                'first_name' => 'Vera',
                'last_name' => 'Stepanyan',
                'email' => 'vera@gmail.com',
                'password' => Hash::make('password'), // Ensure to hash the password
                'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
                'reputation' => 1000,
            ]
        );
        User::create(
            [
                'username' => 'Spikey',
                'first_name' => 'Spike',
                'last_name' => 'Owens',
                'email' => 'spike@gmail.com',
                'password' => Hash::make('password'), // Ensure to hash the password
                'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
                'reputation' => 1000,
            ]
        );
    }
}
