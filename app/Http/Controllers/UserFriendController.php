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

}
