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
}
