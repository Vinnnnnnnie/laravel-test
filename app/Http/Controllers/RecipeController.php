<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Validation\Rules\File;
use App\Http\Controllers\RecipeImageController;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Ingredient;
use App\Models\Step;

use function Laravel\Prompts\error;

class RecipeController extends Controller
{
    //
    public function index()
    {
        return Inertia::render(
            'Recipes/Index',
            [
                'recipes' => self::scrollableRecipeList(),
            ]
        );
    }

    public function scrollableRecipeList()
    {
        return Inertia::scroll(
            fn() => Recipe::with(
                [
                    'user',
                    'comments' => function ($query): void {
                        $query->select('id', 'user_id', 'recipe_id');
                    },
                    'savedUsers' => function ($query): void {
                        $query->select('user_id', 'recipe_id');
                    },
                    'tags',
                ]
            )
            ->select(
                'id',
                'title',
                'user_id',
                'created_at',
                'preparation_time',
                'cooking_time',
                'servings',
                'difficulty',
                'image_path'
            )
            ->orderBy('created_at', 'desc')
            ->paginate()
        );
    }
    public function show(Recipe $recipe)
    {
        $recipe->load('user', 'comments', 'tags', 'ingredients', 'steps');
        $comments = $recipe->comments;
        $tags = $recipe->tags;
        $comments->load('user');
        return Inertia::render(
            'Recipes/Show',
            [
                'recipe' => $recipe,
                'comments' => $comments,
                'tags' => $tags,
            ]
        );
        // return view('recipes.show', ['recipe' => $recipe]);
    }
    public function create()
    {
        $tags = Tag::orderBy('name', 'asc')->get();
        return Inertia::render('Recipes/Create', ['tags' => $tags]);
    }

    public function store(Request $request)
    {

        if (isset($request->image)) {

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
            'tags' => 'array',
        ]);

        // $validatedOthers = $request->validate([
        //     'ingredients' => 'required|array',
        //     'steps' => 'required|array',
        // ]);

        $recipe = Recipe::create($validated);
        if ($request->tags !== null) {
            $recipe->tags()->sync($request->tags);
        }

        if ($request->ingredients !== null) {
            $counter = 0;
            foreach ($request->ingredients as $ingredient) {
                Ingredient::create(
                    [
                        'name' => $ingredient['value'],
                        'number' => $counter,
                        'recipe_id' => $recipe->id,
                    ]
                );
                $counter++;
            }
        }
        if ($request->steps !== null) {
            $counter = 0;
            foreach ($request->steps as $step) {
                Step::create(
                    [
                        'step' => $step['value'],
                        'number' => $counter,
                        'recipe_id' => $recipe->id,
                    ]
                );
                $counter++;
            }
        }
        User::addReputation(auth()->user(), 1);
        return redirect()->route('recipes.index')->with('success', 'Recipe added successfully!');
    }
    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->user()->id) {
            return back()->withErrors('Operation not permitted.');
        }
        User::subtractReputation(auth()->user(), 1);
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id)->load(['ingredients', 'steps', 'tags']);
        if ($recipe->user_id !== auth()->user()->id) {
            return back()->withErrors('You are not the owner of this recipe.');
        }
        $tags = Tag::orderBy('name', 'asc')->get();
        return Inertia::render('Recipes/Edit', ['recipe' => $recipe, 'tags' => $tags]);
    }

    public function search(Request $request)
    {
        $term = $request->term;
        $validated = $request->validate(['term' => 'required|max:64']);
        $recipes = Inertia::scroll(fn() => Recipe::query()
            ->select('users.image_path', 'recipes.image_path', 'recipes.*', 'users.username')
            ->join('users', 'users.id', '=', 'recipes.user_id')
            ->where('recipes.title', 'LIKE', '%' . $term . '%')
            ->orWhere('users.username', 'LIKE', $term . '%')
            ->with(
                [
                    'user',
                    'comments' => function ($query): void {
                        $query->select('id', 'user_id', 'recipe_id');
                    },
                    'savedUsers' => function ($query): void {
                        $query->select('user_id', 'recipe_id');
                    },
                    'tags']
            )
            ->orderBy('recipes.created_at', 'DESC')
            ->paginate(15));
        $users = User::query()
            ->select('image_path', 'username', 'id', 'reputation')
            ->where('username', 'LIKE', $term . '%')
            ->limit(5)
            ->get();
        return Inertia::render('Recipes/Search', ['recipes' => $recipes, 'users' => $users]);
    }

    public function update(Request $request)
    {
        if (isset($request->image)) {
            $image_path = $request->image->store("recipes", 'public');
            $image_path = str_replace('recipes/', '', $image_path);
            $request->merge(['image_path' => $image_path]);
        }

        // if(isset($request->image))
        // {

        //     $image_path = $request->image->store("recipes", 'public');

        //     $image_path = str_replace('recipes/', '', $image_path);
        //     $request->merge(['image_path' => $image_path]);
        // }

        $validated = $request->validate([
            'id' => 'required|integer|exists:recipes',
            'title' => 'required|string|max:255',
            'preparation_time' => 'required|integer|min:1',
            'cooking_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'image_path' => 'string',
        ]);

        $validatedOthers = $request->validate([
            'ingredients' => 'required|array',
            'steps' => 'required|array',
        ]);


        $recipe = Recipe::find($request->input('id'));
        if ($recipe->user_id !== auth()->user()->id) {
            return back()->withErrors('You can only update your own recipes');
        }
        $recipe->update($validated);
        $recipe->ingredients()->delete();
        $recipe->steps()->delete();
        if ($request->ingredients !== null) {
            $counter = 0;
            foreach ($request->ingredients as $ingredient) {
                Ingredient::create(
                    [
                        'name' => $ingredient['name'],
                        'number' => $counter,
                        'recipe_id' => $recipe->id,
                    ]
                );
                $counter++;
            }
        }
        if ($request->steps !== null) {
            $counter = 0;
            foreach ($request->steps as $step) {
                Step::create(
                    [
                        'step' => $step['step'],
                        'number' => $counter,
                        'recipe_id' => $recipe->id,
                    ]
                );
                $counter++;
            }
        }
        if ($request->tags !== null) {
            $recipe->tags()->sync($request->tags);
        }
        //
        $recipe->refresh();

        return redirect()->route('recipes.show',$recipe);
    }
}
