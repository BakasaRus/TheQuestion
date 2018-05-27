<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show(User $user)
    {
    	return $user->load(['answers', 'questions.themes', 'subscriptions']);
    }

    public function deactivate(Request $request, User $user)
    {
    	if ($request->user()->role < 1)
    		return response(['message' => 'You have not permissions to (de)activate users'], 403);
    	$user->is_banned = !$user->is_banned;
    	$user->save();
    	return ['message' => 'Success!'];
    }
}
