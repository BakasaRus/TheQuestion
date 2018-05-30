<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['show', 'store']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:10|confirmed',
            'name' => 'required',
            'surname' => 'required'
        ]);

        User::create($validated);

        return ['message' => 'Success!'];
    }

    public function show(User $user)
    {
    	return $user->load(['answers', 'questions.themes', 'questions.answers', 'subscriptions']);
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
