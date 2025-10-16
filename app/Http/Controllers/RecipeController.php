<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\UserFriend;
use App\Models\User;
class RecipeController extends Controller
{
    //
    public function index() {
        
        $recipes = Recipe::with(['comment' => function ($query) {
            $query->orderBy('created_at', 'desc')
                ->limit(3);
        }, 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $friends = UserFriend::query()
            ->join('users', 'users.id', '=', 'user_friends.friend_user_id')
            ->where('user_friends.user_id', '=',  auth()->user()->id)
            ->select(['user_friends.*', 'users.name', 'users.email', 'users.image_path'])
            ->get();
        return view('recipes.index', ['recipes' => $recipes, 'friends' => $friends]);
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
            'user_id' => 'required|integer|exists:users'
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
