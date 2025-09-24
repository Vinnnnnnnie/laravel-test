<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
class RecipeController extends Controller
{
    //
    public function index() {
        $recipes = Recipe::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('recipes.index', ['recipes' => $recipes]);
    }
    public function show($id) {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', ['recipe' => $recipe]);
    }
    public function create() {
        // return view('recipes.create');
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'preparation_time' => 'required|integer|min:1',
            'cooking_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
        ]);
        Recipe::create($validated);
        return redirect('/recipes')->with('success', 'Recipe added successfully!');
    }
    public function edit($id) {
        $recipe = Recipe::findOrFail($id);
        // return view('recipes.edit', ['recipe' => $recipe]);
    }
}
