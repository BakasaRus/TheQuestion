<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function store(Request $request, Question $question)
    {
    	$validated = $request->validate([
    		'text' => 'required|min:140'
    	]);
    	$validated['author_id'] = $request->user()->id;
    	$question->answers()->create($validated);

    	return ['message' => 'Success!'];
    }
}
