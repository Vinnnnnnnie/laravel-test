<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->count(10)->create();
        User::create([
            'name' => 'Vincent Owens',
            'email' => 'vincent@gmail.com',
            'password' => '$2y$12$UZHK2NQa78Qc9YMhDH107uMrb4zG6SjtnrGSqavFkOC11aVQLOeEm', // Ensure to hash the password
            'image_path' => '01.jpg'
        ]);
        User::create([
            'name' => 'Tom Bozier',
            'email' => 'tom@gmail.com',
            'password' => password_hash('password', PASSWORD_BCRYPT), // Ensure to hash the password
            'image_path' => '02.jpg'

        ]);
        User::create([
            'name' => 'Ellen Maxwell',
            'email' => 'ellen@gmail.com',
            'password' => password_hash('password', PASSWORD_BCRYPT), // Ensure to hash the password
            'image_path' => '03.jpg'

        ]);
        User::create(
        [
            'name' => 'Vera Stepanyan',
            'email' => 'vera@gmail.com',
            'password' => password_hash('password', PASSWORD_BCRYPT), // Ensure to hash the password
            'image_path' => '04.jpg'

        ]
        );
        User::create(
        [
            'name' => 'Spike Owens',
            'email' => 'spike@gmail.com',
            'password' => password_hash('password', PASSWORD_BCRYPT), // Ensure to hash the password
            'image_path' => '05.jpg'
        ]
        );
    }
}
