<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['text', 'author_id'];

    public function commentable()
    {
    	return $this->morphTo();
    }

    public function author()
    {
    	return $this->belongsTo(User::class, 'author_id');
    }

    public function votes()
    {
    	return $this->morphMany(Vote::class, 'voteable');
    }
}
