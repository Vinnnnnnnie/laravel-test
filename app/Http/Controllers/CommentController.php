<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'recipe_id' => $request->input('recipe_id'),
            'user_id' => auth()->user()->id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
