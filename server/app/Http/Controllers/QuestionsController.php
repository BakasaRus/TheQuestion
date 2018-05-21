<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function index()
    {
    	return Question::with('themes')->get();
    }

    public function show(Question $question)
    {
    	return $question->load(['themes', 'answers', 'author']);
    }
}
