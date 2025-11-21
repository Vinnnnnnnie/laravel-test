<?php

use App\Models\Bike;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserFriendController;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// Bike Routes
Route::middleware('auth')->controller(BikeController::class)->group(function () {
    Route::get('/bikes', 'index')->name('bikes.index');
    Route::get('/bikes/create', 'create')->name('bikes.create');
    Route::get('/bikes/{bike}', 'show')->name('bikes.show');
    Route::post('/bikes', 'store')->name('bikes.store');
    Route::delete('/bikes/{bike}', 'destroy')->name('bikes.destroy');
});