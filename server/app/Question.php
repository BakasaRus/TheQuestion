<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function author()
    {
    	return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function subscribers()
    {
        return $this->morphMany(Subscription::class, 'subscribeable');
    }

    public function answers()
    {
    	return $this->hasMany(Answer::class);
    }

    public function votes()
    {
    	return $this->morphMany(Vote::class, 'voteable');
    }

    public function themes()
    {
    	return $this->belongsToMany(Theme::class);
    }
}
