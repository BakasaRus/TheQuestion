<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show(User $user)
    {
    	return $user->load(['answers', 'questions.themes', 'subscriptions']);
    }
}
