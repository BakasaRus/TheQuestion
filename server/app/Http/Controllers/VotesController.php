<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Answer;
use App\Question;
use App\Vote;

class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request, $model, $id, $status)
    {
    	switch ($model) {
    		case 'questions': $model = 'App\\Question'; break;
    		case 'answers': $model = 'App\\Answer'; break;
    		case 'comments': $model = 'App\\Comment'; break;
    	}
    	$voteable = $model::find($id);
    	$shouldCreate = $voteable->votes->where('user_id', $request->user()->id)->isEmpty();
    	if ($shouldCreate)
    	{
    		$vote = $voteable->votes()->create([
    			'user_id' => $request->user()->id,
    			'status' => $status
    		]);
    		switch ($status)
    		{
    			case 'up': $vote->changeRating(1); break;
    			case 'down': $vote->changeRating(-1); break;
    		}
    	}
    	else 
    	{
    		$vote = $voteable->votes->where('user_id', $request->user()->id)->first();
    		if ($status == $vote->status)
    		{
	    		switch ($status)
	    		{
	    			case 'up': $vote->changeRating(-1); break;
	    			case 'down': $vote->changeRating(1); break;
	    		}
	    		$vote->delete();
    		}
    		else
    		{
	    		switch ($status)
	    		{
	    			case 'up': $vote->changeRating(2); break;
	    			case 'down': $vote->changeRating(-2); break;
	    		}
    			$vote->status = $status;
    			$vote->save();
    		}
    	}
    	return ['message' => 'Success!'];
    }
}
