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

        $user->following()->attach($userToFollow);

        return redirect()->route('users.show', ['user' => $userToFollow])->with('success', 'Followed!');

    }
    public function unfollow(Request $request)
    {
        $userToUnfollow = $request->friend_user_id;
        $user = auth()->user();

        $user->following()->detach($userToUnfollow);

        return redirect()->route('users.show', ['user' => $userToUnfollow])->with('success', 'Unfollowed!');
    }
    public function edit()
    {
        return Inertia::render('Users/Edit');
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
        return Inertia::render('Users/SavedRecipes', 
            ['recipes' => Inertia::scroll(fn () =>  
                auth()
                    ->user()
                    ->savedRecipes()
                    ->with(
                    [
                        'user',
                        'comments' => function ($query) {
                            $query->select('id', 'user_id', 'recipe_id');
                        }, 
                        'savedUsers' => function ($query) {
                            $query->select('user_id', 'recipe_id');
                        },
                        'tags'
                    ])
                    ->orderBy('created_at', 'desc')
                    ->paginate()
                )]);
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'bio' => 'nullable|string|max:255',
            'image_path' => 'string'
        ]);

        $user = User::find(auth()->user()->id);
        $user->update($validated);

        return redirect()->route('users.show', auth()->user())->with('success', 'Profile updated successfully!');
    }
}
