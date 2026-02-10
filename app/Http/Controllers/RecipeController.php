<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\UserFriend;
use App\Models\User;
use App\Http\Controllers\UserFriendController;
use Illuminate\Validation\Rules\File;
use App\Http\Controllers\RecipeImageController;
use Illuminate\Support\Facades\Storage;


class RecipeController extends Controller
{
    //
    public function index() {
        
        $recipes = Recipe::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'user', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $userFriends = new UserFriendController();
        $userFriends->updateFriendsList();

        return view('recipes.index', ['recipes' => $recipes]);
    }
    public function show(Recipe $recipe) {
        return view('recipes.show', ['recipe' => $recipe]);
    }
    public function create() {
        return view('recipes.create');
    }
    public function store(Request $request) {
        if(isset($request->image))
        {
            $image_path = $request->image->store("recipes", 'public');
            $image_path = str_replace('recipes/', '', $image_path); 
            $request->merge(['image_path' => $image_path]);
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'preparation_time' => 'required|integer|min:1',
            'cooking_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'user_id' => 'required|integer|exists:users,id',
            'image_path' => 'string'
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
        return view('recipes.edit', ['recipe' => $recipe]);
    }

    public function search(Request $request) {
        $term = $request->term;
        $validated = $request->validate(['term' => 'required|max:64']);
        $recipes = Recipe::query()
            ->select('users.image_path as user_image', 'recipes.image_path as recipe_image', 'recipes.*', 'users.name')
            ->join('users', 'users.id', '=', 'recipes.user_id')
            ->where('recipes.title', 'LIKE', '%'.$term.'%')
            ->orWhere('users.name', 'LIKE', '%'.$term.'%')
            ->orderBy('recipes.created_at', 'DESC')
            ->paginate(
                $perPage = 15, $columns = ['*'], $pageName = 'recipes'
            );
        $users = User::query()
            ->select('image_path', 'name', 'id')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->paginate(
                $perPage = 5, $columns = ['*'], $pageName = 'users'
            );
        return view('recipes.search', ['recipes' => $recipes, 'users' => $users]);
    }

    public function update(Request $request) {
        $image_path = $request->image->store("recipes", 'public');
        $image_path = str_replace('recipes/', '', $image_path); 
        $request->merge(['image_path' => $image_path]);
        $validated = $request->validate([
            'id' => 'required|integer|exists:recipes',
            'title' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'preparation_time' => 'required|integer|min:1',
            'cooking_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'image_path' => 'string'
        ]);
        Recipe::where('recipes.id', '=' ,$request->input('id'))
            ->update($validated);
        $recipe = Recipe::with(['user'])
        ->where('recipes.id', '=' ,$request->input('id'))
        ->get();
        return redirect()->route('users.show', auth()->user())->with('success', 'Recipe updated successfully!');
    }
}
