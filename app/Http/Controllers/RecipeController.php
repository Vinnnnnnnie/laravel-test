<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\UserFriend;
use App\Models\User;
use App\Models\Tag;
use App\Http\Controllers\UserFriendController;
use Illuminate\Validation\Rules\File;
use App\Http\Controllers\RecipeImageController;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Ingredient;
use App\Models\Step;

class RecipeController extends Controller
{
    //
    public function index() {
        return Inertia::render('Recipes/Index', 
            ['recipes' => self::scrollableRecipeList()]);
    }

    public function scrollableRecipeList() {
        return Inertia::scroll(fn () => Recipe::with(
                    [
                        'user',
                        'comments' => function ($query) {
                            $query->select('id', 'user_id', 'recipe_id');
                        }, 
                        'savedUsers' => function ($query) {
                            $query->select('user_id', 'recipe_id');
                        },
                        'tags'
                    ]
                )
                ->select('id', 'title', 'user_id', 
                    'created_at', 'preparation_time', 
                    'cooking_time', 'servings', 'difficulty', 
                    'image_path')
                ->orderBy('created_at', 'desc')->paginate()
        );
    }
    public function show(Recipe $recipe) {
        $recipe->load('user', 'comments', 'tags', 'ingredients', 'steps');
        $comments = $recipe->comments;
        $tags = $recipe->tags;
        $comments->load('user', );
        return Inertia::render('Recipes/Show', 
            [
                'recipe' => $recipe,
                'comments' => $comments,
                'tags' => $tags
            ]);
        // return view('recipes.show', ['recipe' => $recipe]);
    }
    public function create() {
        $tags = Tag::orderBy('name', 'asc')->get();
        return Inertia::render('Recipes/Create', ['tags' => $tags]);
    }

    public function store(Request $request) {
        if(isset($request->image))
        {
            $image_path = $request->image->store("recipes", 'public');
            $image_path = str_replace('recipes/', '', $image_path); 
            $request->merge(['image_path' => $image_path]);
        }
        $request->merge(['user_id' => auth()->user()->id]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'preparation_time' => 'required|integer|min:1',
            'cooking_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'user_id' => 'required|integer|exists:users,id',
            'image_path' => 'string',
            'tags' => 'array'
        ]);
        $validatedOthers = $request->validate([
            'ingredients' => 'required|array',
            'steps' => 'required|array',
        ]);

        $recipe = Recipe::create($validated);
        if ($request->tags !== NULL)
        {
            $recipe->tags()->sync($request->tags);
        }
        
        if ($request->ingredients !== NULL)
        {
            $counter = 0;
            foreach ($request->ingredients as $ingredient)
            {
                Ingredient::create(
                    [
                        'name' => $ingredient,
                        'number' => $counter,
                        'recipe_id' => $recipe->id
                    ]);
                $counter++;
            }
        }
        if ($request->steps !== NULL)
        {
            $counter = 0;
            foreach ($request->steps as $step)
            {
                Step::create(
                    [
                        'step' => $step,
                        'number' => $counter,
                        'recipe_id' => $recipe->id
                    ]);
                $counter++;
            }
        }
        return redirect()->route('recipes.index')->with('success', 'Recipe added successfully!');
    }
    public function destroy(Recipe $recipe) {
        if ($recipe->user_id === auth()->user()->id)
        {
            $recipe->delete();
            return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
        }
        return back()->withError('Operation not permitted.');
    }

    public function edit($id) {
        $recipe = Recipe::findOrFail($id)->load(['ingredients', 'steps']);
        $tags = Tag::orderBy('name', 'asc')->get();
        return Inertia::render('Recipes/Edit', ['recipe' => $recipe, 'tags' => $tags]);
    }

    public function search(Request $request) {
        $term = $request->term;
        $validated = $request->validate(['term' => 'required|max:64']);
        $recipes = Inertia::scroll(fn () => Recipe::query()
            ->select('users.image_path', 'recipes.image_path', 'recipes.*', 'users.name')
            ->join('users', 'users.id', '=', 'recipes.user_id')
            ->where('recipes.title', 'LIKE', '%'.$term.'%')
            ->orWhere('users.name', 'LIKE', $term.'%')
            ->with(
            [
                'user',
                'comments' => function ($query) {
                    $query->select('id', 'user_id', 'recipe_id');
                },
                'savedUsers' => function ($query) {
                    $query->select('user_id', 'recipe_id');
                },
                'tags'])
            ->orderBy('recipes.created_at', 'DESC')
            ->paginate(15));
        $users = User::query()
            ->select('image_path', 'name', 'id', 'reputation')
            ->where('name', 'LIKE', $term.'%')
            ->limit(5)
            ->get();
        return Inertia::render('Recipes/Search', ['recipes' => $recipes, 'users' => $users]);
    }

    public function update(Request $request) {
        if ($request->image)
        {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif'
            ]);
            $image_path = $request->image->store("recipes", 'public');
            $image_path = str_replace('recipes/', '', $image_path); 
            $request->merge(['image_path' => $image_path]);
        }
        
        $validated = $request->validate([
            'id' => 'required|integer|exists:recipes',
            'title' => 'required|string|max:255',
            'preparation_time' => 'required|integer|min:1',
            'cooking_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'image_path' => 'string'
        ]);

        $validatedOthers = $request->validate([
            'ingredients' => 'required|array',
            'steps' => 'required|array',
        ]);


        $recipe = Recipe::find($request->input('id'));
        $recipe->update($validated);
        $recipe->ingredients()->delete();
        $recipe->steps()->delete();
        if ($request->ingredients !== NULL)
        {
            $counter = 0;
            foreach ($request->ingredients as $ingredient)
            {
                Ingredient::create(
                    [
                        'name' => $ingredient,
                        'number' => $counter,
                        'recipe_id' => $recipe->id
                    ]);
                $counter++;
            }
        }
        if ($request->steps !== NULL)
        {
            $counter = 0;
            foreach ($request->steps as $step)
            {
                Step::create(
                    [
                        'step' => $step,
                        'number' => $counter,
                        'recipe_id' => $recipe->id
                    ]);
                $counter++;
            }
        }
        if ($request->tags !== NULL)
        {
            $recipe->tags()->sync($request->tags);
        }

        $recipe = Recipe::with(['user'])
        ->where('recipes.id', '=' ,$request->input('id'))
        ->get();
        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully!');
    }
}
