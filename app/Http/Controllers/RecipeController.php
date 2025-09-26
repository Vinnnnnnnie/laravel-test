<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Comment;
class RecipeController extends Controller
{
    //
    public function index() {
        
        $recipes = Recipe::with('comment')->orderBy('created_at', 'desc')->paginate(10);
        return view('recipes.index', ['recipes' => $recipes]);
    }
    public function show(Recipe $recipe) {
        return view('recipes.show', ['recipe' => $recipe]);
    }
    public function create() {
        return view('recipes.create');
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
    public function destroy(Recipe $recipe) {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }
    public function edit($id) {
        $recipe = Recipe::findOrFail($id);
        // return view('recipes.edit', ['recipe' => $recipe]);
    }
}
