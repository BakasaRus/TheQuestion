<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
	protected $fillable = ['name'];

    public function questions()
    {
    	return $this->belongsToMany(Question::class);
    }

    public function subscribers()
    {
        return $this->manyMorph(Subscription::class, 'subscribeable');
    }
}
