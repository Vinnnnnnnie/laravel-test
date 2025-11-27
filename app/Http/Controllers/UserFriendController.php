<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFriend;
class UserFriendController extends Controller
{


    public function store(Request $request)
    {
        $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'friend_user_id' => 'required|integer|exists:users,id'
            ]);

        UserFriend::create($validated);
        $this->updateFriendsList();
        return redirect()->route('users.show', $request->friend_user_id)->with('success', 'Friend added successfully!');
    }

    public function updateFriendsList():void
    {
        $friends = UserFriend::query()
            ->join('users', 'users.id', '=', 'user_friends.friend_user_id')
            ->where('user_friends.user_id', '=',  auth()->user()->id)
            ->select(['user_friends.*', 'users.name', 'users.email', 'users.image_path'])
            ->get();
        session(['friendslist' => $friends]);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'friend_user_id' => 'required|integer|exists:users,id'
        ]);

        UserFriend::where('user_id', $request->user_id)->where('friend_user_id', $request->friend_user_id)->delete();

        $this->updateFriendsList();
        return redirect()->route('users.show', $request->friend_user_id)->with('success', 'Friend deleted successfully!');
    }
}
