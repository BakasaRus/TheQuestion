<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
