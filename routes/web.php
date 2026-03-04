<?php

use App\Models\Bike;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Inertia\Inertia;


Route::inertia('/', 'Home')->name('home');

Route::inertia('/cv', 'Cv')->name('cv');

Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register',  'showRegister')->name('show.register');
    Route::get('/login',  'showLogin')->name('show.login');
    Route::post('/register',  'register')->name('register');
    Route::post('/login',  'login')->name('login');
});

Route::get('/public/images/users/{filename}', function ($filename) {
    $path = public_path('storage/users/' . $filename);

    if (!file_exists($path) || is_dir($filename)) {
        $path = public_path('storage/users/Aubergine.jpg');
    }
    return response()->file($path);
})->name('image.users');

Route::get('/public/images/recipes/{filename}', function ($filename) {
    $path = public_path('storage/recipes/' . $filename);
    if (!file_exists($path) || is_dir($filename)) {
        $path = public_path('storage/recipes/Plate.jpg');
    }
    return response()->file($path);
})->name('image.recipes');

Route::get('/public/images/website/{filename}', function ($filename) {
    $path = public_path('storage/website/' . $filename);
    if (!file_exists($path) || is_dir($filename)) {
        abort(404);
    }
    return response()->file($path);
})->name('image.website');

// Recipe Routes
Route::middleware('auth')->controller(RecipeController::class)->group(function () {
    Route::get('/recipes', 'index')->name('recipes.index');
    Route::post('/recipes', 'store')->name('recipes.store');
    Route::get('/recipes/create', 'create')->name('recipes.create');
    Route::get('/recipes/search', 'search')->name('recipes.search');
    Route::get('/recipes/edit/{recipe}', 'edit')->name('recipes.edit');
    Route::get('/recipes/{recipe}', 'show')->name('recipes.show');
    Route::post('/recipes/update/{id}', 'update')->name('recipes.update');
    Route::delete('/recipes/{recipe}', 'destroy')->name('recipes.destroy');
});

Route::post('/recipes/{recipe}', [CommentController::class, 'store'])->name('comments.store');

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('/users/edit', 'edit')->name('users.edit');
    Route::get('/users/savedRecipes', 'savedRecipes')->name('users.savedRecipes');
    Route::get('/users/{user}','show')->name('users.show');
    Route::post('/users/follow', 'follow')->name('users.follow');
    Route::delete('/users/unfollow', 'unfollow')->name('users.unfollow');
    Route::post('/users/update', 'update')->name('users.update');
    Route::post('/users/saveRecipe/{recipe}', 'addSavedRecipe')->name('users.addSavedRecipe');
    Route::post('/users/removeRecipe/{recipe}', 'removeSavedRecipe')->name('users.removeSavedRecipe');
});

Route::get('/games', function() 
{
    return Inertia::render('ComingSoon');
})->name('games.index');

Route::get('/games/*', function() 
{
    return Inertia::render('ComingSoon');
});