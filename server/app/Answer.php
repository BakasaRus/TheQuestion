<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question()
    {
    	return $this->belongsTo(Question::class);
    }

    public function author()
    {
    	return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function votes()
    {
    	return $this->morphMany(Vote::class, 'voteable');
    }
}
