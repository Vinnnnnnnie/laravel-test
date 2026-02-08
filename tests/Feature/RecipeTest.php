<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\RecipeSeeder;
use App\Models\Recipe;

class RecipeTest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;

    public function test_recipes_can_be_deleted(): void
    {
        $recipe = Recipe::factory()->create();
        $recipe->delete();
        $this->assertModelMissing($recipe);
    }

    public function test_recipes_can_be_created(): void
    {
        $recipe = Recipe::factory()->create();
        $this->assertModelExists($recipe);
    }

    public function test_recipes_can_be_updated(): void
    {
        $recipe = Recipe::factory()->create();
        $recipe->update(
            [
                'title' => 'Recipe that has been updated'
            ]
        );
        $this->assertDatabaseHas('recipes', [
            'title' => 'Recipe that has been updateds',
        ]);
    }
    
}
