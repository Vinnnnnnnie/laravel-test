<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_homepage_success(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Vincent Owens - Software Developer');
    }

    public function test_this(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Vincent Owens - Software Developer');
    }
}
