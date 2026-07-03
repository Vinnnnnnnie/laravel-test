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
        return Recipe::inRandomOrder()->first();
    }

    public function getRecipeById(int $id): Recipe {
        return Recipe::find($id, 'recipe_id');
    }

    public function getLatestRecipesPaginated() {
        return Recipe::with(
                [
                    'user',
                    'comments' => function ($query): void {
                        $query->select('id', 'user_id', 'recipe_id');
                    },
                    'savedUsers' => function ($query): void {
                        $query->select('user_id', 'recipe_id');
                    },
                    'tags',
                ])
                ->select(
                    'id',
                    'title',
                    'user_id',
                    'created_at',
                    'preparation_time',
                    'cooking_time',
                    'servings',
                    'difficulty',
                    'image_path')
                ->orderBy('created_at', 'desc')
                ->paginate();
    }
    /**
     * @return HasMany<Comment, $this>
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, $this>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * returns all tags from Pivot
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Tag, $this, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Users who have saved recipe
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User, $this, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function savedUsers()
    {
        return $this->belongsToMany(User::class, 'saved_recipes');
    }
    /**
     * Steps for the recipe
     * @return HasMany<Step, $this>
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }
    /**
     * Ingredients for recipe
     * @return HasMany<Ingredient, $this>
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
