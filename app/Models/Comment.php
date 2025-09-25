<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'user_id', 'recipe_id'];

    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;
}
