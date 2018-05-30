<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['text', 'author_id'];

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
