<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name', 'recipe_id', 'number'];

    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;
    
}
