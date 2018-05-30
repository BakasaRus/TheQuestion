<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
	protected $fillable = ['name'];

    public function questions()
    {
    	return $this->belongsToMany(Question::class);
    }

    public function subscribers()
    {
        return $this->morphMany(Subscription::class, 'subscribeable');
    }
}
