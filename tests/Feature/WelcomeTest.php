<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as AssertableInertia;
use Illuminate\Support\Facades\Storage;

class WelcomeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_homepage_success(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);

        $response->assertInertia(fn (AssertableInertia $page) => 
            $page->component('Home')
        );

    }

    public function test_cv_success(): void
    {
        $response = $this->get(route('cv'));

        $response->assertStatus(200);

        $response->assertInertia(fn (AssertableInertia $page) => 
            $page->component('Cv')
        );


    }

    public function test_vincent_image_exists(): void
    {
        $this->assertTrue(Storage::disk('public')->exists('website/me.png'));
    }
}
