<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFriend;
class UserFriendController extends Controller
{
    public function index() {
        
        $friends = UserFriend::with(['user', 'friend'])->where('user_id', '=', auth()->user()->id)->orderBy('created_at', 'desc');
        return view('friends.index', ['friends' => $friends]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'friend_user_id' => 'required|integer|exists:users,id'
            ]);

        UserFriend::create($validated);
        // return redirect()->back()->with('success', 'Friend added successfully!');
        return redirect()->route('users.show', $request->user_id)->with('success', 'Friend added successfully!');
    }
}
