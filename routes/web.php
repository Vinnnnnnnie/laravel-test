<?php

use App\Models\Bike;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/recipes', function () {
    return view('recipes.index');
})->name('recipes.index');

Route::get('/bikes', [BikeController::class, 'index'])->name('bikes.index');
Route::get('/bikes/create', [BikeController::class, 'create'])->name('bikes.create');
Route::get('/bikes/{id}', [BikeController::class, 'show'])->name('bikes.show');
