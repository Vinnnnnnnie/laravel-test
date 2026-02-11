<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;

class UserController extends Controller
{
    public function show(User $user)
    {
        $recipes = Recipe::where('user_id','=',$user->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('users.show', ['user' => $user, 'recipes' => $recipes]);
    }
    public function edit()
    {
        return view('users.edit');
    }
    public function addSavedRecipe(Recipe $recipe)
    {
        $user = auth()->user();
        
        $user->savedRecipes()->attach($recipe->id);
        return redirect()->route('recipes.show', ['recipe' => $recipe])->with('success', 'Added to your saved recipes!');
    }
    public function removeSavedRecipe(Recipe $recipe)
    {
        $user = auth()->user();
        
        $user->savedRecipes()->detach($recipe->id);
        return redirect()->route('recipes.show', ['recipe' => $recipe])->with('success', 'Removed from your saved recipes!');
    }

    public function update(Request $request)
    {
        if ($request->image)
        {
            $image_path = $request->image->store("users", 'public');
            $image_path = str_replace('users/', '', $image_path); 
            $request->merge(['image_path' => $image_path]);
        }
        $validated = $request->validate([
            'name' => 'required|string',
            'bio' => 'string|max:255',
            'image_path' => 'string'
        ]);
        $user = User::find(auth()->user()->id);
        $user->update($validated);

        return redirect()->route('users.show', auth()->user())->with('success', 'Profile updated successfully!');
    }
}
