<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(GarageSeeder::class);
        $this->call(BikeSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(UserFriendSeeder::class);
    }
}
