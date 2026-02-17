<?php

use App\Models\Bike;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserFriendController;
use App\Http\Controllers\UserController;
use Inertia\Inertia;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return Inertia::render('Home');
});

Route::get('/cv', function() {
    return view('cv');
})->name('cv');

Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register',  'showRegister')->name('show.register');
    Route::get('/login',  'showLogin')->name('show.login');
    Route::post('/register',  'register')->name('register');
    Route::post('/login',  'login')->name('login');
});

Route::get('/public/images/users/{filename}', function ($filename) {
    $path = public_path('storage/users/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('image.users');

Route::get('/public/images/recipes/{filename}', function ($filename) {
    $path = public_path('storage/recipes/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('image.recipes');

Route::get('/public/images/website/{filename}', function ($filename) {
    $path = public_path('storage/website/' . $filename);
    if (!file_exists($path)) {
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
Route::middleware('auth')->controller(UserFriendController::class)->group(function () {
    Route::post('/friends','store')->name('friends.store');
    Route::delete('/friends', 'destroy')->name('friends.destroy');
});

Route::post('/recipes/{recipe}', [CommentController::class, 'store'])->name('comments.store');

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('/users/edit', 'edit')->name('users.edit');
    Route::get('/users/savedRecipes', 'savedRecipes')->name('users.savedRecipes');
    Route::get('/users/{user}','show')->name('users.show');
    Route::post('/users/update', 'update')->name('users.update');
    Route::post('/users/saveRecipe/{recipe}', 'addSavedRecipe')->name('users.addSavedRecipe');
    Route::post('/users/removeRecipe/{recipe}', 'removeSavedRecipe')->name('users.removeSavedRecipe');
});

// Bike Routes
Route::middleware('auth')->controller(BikeController::class)->group(function () {
    Route::get('/bikes', 'index')->name('bikes.index');
    Route::get('/bikes/create', 'create')->name('bikes.create');
    Route::get('/bikes/{bike}', 'show')->name('bikes.show');
    Route::post('/bikes', 'store')->name('bikes.store');
    Route::delete('/bikes/{bike}', 'destroy')->name('bikes.destroy');
});

Route::get('/games', function() 
{
    return view('coming-soon');
})->name('games.index');

Route::get('/games/*', function() 
{
    return view('coming-soon');
});