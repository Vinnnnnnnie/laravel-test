<?php

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
        User::factory()->count(10)->create();
        $directory = public_path('storage/users');
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));

        User::create([
            'name' => 'Vincent Owens',
            'email' => 'vincent@gmail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
            'reputation' => 1000
        ]);
        User::create([
            'name' => 'Tom Bozier',
            'email' => 'tom@gmail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
            'reputation' => 1000
        ]);
        User::create([
            'name' => 'Ellen Maxwell',
            'email' => 'ellen@gmail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',

        ]);
        User::create(
        [
            'name' => 'Vera Stepanyan',
            'email' => 'vera@gmail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
            'reputation' => 1000
        ]
        );
        User::create(
        [
            'name' => 'Spike Owens',
            'email' => 'spike@gmail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'image_path' => $scanned_directory[array_rand($scanned_directory)] ?? 'default.jpg',
            'reputation' => 1000
        ]
        );
    }
}
