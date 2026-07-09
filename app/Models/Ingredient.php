<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\IngredientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Ingredient extends Model
{
    /** @use HasFactory<IngredientFactory> */
    use HasFactory;

    protected $fillable = ['name', 'recipe_id', 'number'];

    public static function addIngredientsToRecipe(Recipe $recipe, Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate(
            [
                'ingredients' => 'required|array|min:1',
                'ingredients.*.name' => 'required|string|max:64',
            ],
            [
                'ingredients.required|min:1' => 'You must have 1 ingredient.',
                'ingredients.*.name' => 'Ingredients cannot be greater than 64 characters.',
            ]
        );
        $counter = 0;
        foreach ($validated['ingredients'] as $ingredient) {
            Ingredient::create(
                [
                    'name' => $ingredient['name'],
                    'number' => $counter,
                    'recipe_id' => $recipe->id,
                ]
            );
            $counter++;
        }
        return response()->json(['status' => 'ok', 'msg' => 'Ingredients added successfully.']);
    }
}
