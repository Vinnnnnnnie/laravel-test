<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;
    protected $fillable = ['title', 'preparation_time', 'cooking_time', 'servings', 'difficulty', 'image_path', 'user_id'];

    public function random()
    {
        return Recipe::all()
            ->inRandomOrder()
            ->first();
    }
    /**
     * @return HasMany<Comment, Recipe>
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Recipe>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * returns all tags from Pivot
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Tag, Recipe, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Users who have saved recipe
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User, Recipe, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function savedUsers()
    {
        return $this->belongsToMany(User::class, 'saved_recipes');
    }
    /**
     * Steps for the recipe
     * @return HasMany<Step, Recipe>
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    /**
     * Ingredients for recipe
     * @return HasMany<Ingredient, Recipe>
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
