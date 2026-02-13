<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class testTotalReputation extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $user = new User;
        $this->assertEquals( 10, $user->totalReputation());
    }
}
