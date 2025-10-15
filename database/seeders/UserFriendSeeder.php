<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserFriend;
use Exception as GlobalException;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use PDOException;

class UserFriendSeeder extends Seeder
{
    private $failures = 0;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        UserFriend::factory()->count(100)->create();
        
    }
}
