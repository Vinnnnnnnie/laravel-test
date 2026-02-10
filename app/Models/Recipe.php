<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    protected $fillable = ['title', 'ingredients', 'instructions', 'preparation_time', 'cooking_time', 'servings', 'difficulty', 'image_path', 'user_id'];
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
