<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Theme;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|max:140',
            'themes' => 'required|min:1',
            'anonymous' => 'required'
        ]);
        $question = new Question(['text' => $validated['text']]);
        // First user is anonymous
        $question->author_id = $validated['anonymous'] ? $request->user->id : 1;
        $question->save();
        foreach ($validated['themes'] as $themeName) {
            $theme = Theme::firstOrCreate(['name' => $themeName]);
            $question->themes()->attach($theme);
        }
        return ['message' => 'Success!', 'question' => $question];
    }
}
