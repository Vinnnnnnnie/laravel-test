<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;
use Inertia\Inertia;
class UserController extends Controller
{
    public function show(User $user)
    {
        return Inertia::render('Users/Show',
            ['user' => $user, 
            'recipes' => Inertia::scroll(fn () => Recipe::with(
                    [
                        'user',
                        'comments' => function ($query) {
                            $query->select('id', 'user_id', 'recipe_id');
                        }, 
                        'tags'
                    ]
                )
                ->select('id', 'title', 'user_id', 
                    'created_at', 'preparation_time', 
                    'cooking_time', 'servings', 'difficulty', 
                    'image_path')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')->paginate()
            )
        ]);
    }

    public function follow(Request $request)
    {
        $userToFollow = $request->friend_user_id;
        $user = auth()->user();

        $user->followed()->attach($userToFollow);

        return redirect()->route('users.show', ['user' => $user])->with('success', 'Followed!');

    }
    public function unfollow(Request $request)
    {
        $userToUnfollow = $request->friend_user_id;
        $user = auth()->user();

        $user->followed()->detach($userToUnfollow);

        return redirect()->route('users.show', ['user' => $user])->with('success', 'Unfollowed!');
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
    public function savedRecipes()
    {
        $user = auth()->user();
        $recipes = $user->savedRecipes()->paginate(10);
        return view('users.savedRecipes', ['recipes' => $recipes]);
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
            'bio' => 'nullable|string|max:255',
            'image_path' => 'string'
        ]);
        $user = User::find(auth()->user()->id);
        $user->update($validated);

        return redirect()->route('users.show', auth()->user())->with('success', 'Profile updated successfully!');
    }
}
