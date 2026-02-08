<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\RecipeSeeder;
use App\Models\Recipe;

class RecipeTests extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    
    public function test_recipes_can_be_created(): void
    {
        $this->seed(RecipeSeeder::class);
        $this->assertDatabaseCount('recipes', 42);
    }

    public function test_recipes_can_be_deleted(): void
    {
        $recipe = Recipe::factory()->create();
        $recipe->delete();
        $this->assertModelMissing($recipe);
    }
}
