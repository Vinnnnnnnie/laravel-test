<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    // public function share(Request $request): array
    // {
    //     return [

    //         ...parent::share($request),
    //         //
    //     ];
    // }
    public function share(Request $request): array
    {
        $user = [];
        if (auth()->user())
        {
            $user = auth()->user()->load(
                [
                    'recipes' => function ($query) {
                        $query->select('recipes.id', 'recipes.title', 'recipes.user_id');
                    },
                    'savedRecipes' => function ($query) {
                        $query->select('recipe_id', 'title');
                    },
                    'following' => function ($query) {
                        $query->select('follower_id', 'user_id', 'name', 'image_path');
                    },
                    'followers' => function ($query) {
                        $query->select('user_id', 'follower_id', 'name');
                    }
                ]
            );
        }
        
        return array_merge(parent::share($request), [
            'auth.user' => $user
        ]);
    }
}
