<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['title', 'ingredients', 'instructions', 'preparation_time', 'cooking_time', 'servings', 'difficulty'];
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;
}
