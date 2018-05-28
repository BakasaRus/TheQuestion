<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Answer;
use App\Question;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show($model, $id)
    {
    	switch ($model) {
    		case 'questions': $model = 'App\\Question'; break;
    		case 'answers': $model = 'App\\Answer'; break;
    	}
    	$commentable = $model::with(['comments.author'])->find($id);
    	return $commentable->comments;
    }

    public function store(Request $request, $model, $id)
    {
    	$validated = $request->validate([
    		'text' => 'required'
    	]);
    	$validated['author_id'] = $request->user()->id;
    	
    	switch ($model) {
    		case 'questions': $model = 'App\\Question'; break;
    		case 'answers': $model = 'App\\Answer'; break;
    	}
    	$commentable = $model::find($id);
    	$commentable->comments()->create($validated);

    	return ['message' => 'Success!'];
    }
}
