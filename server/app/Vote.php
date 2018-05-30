<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'status'];
    
    public function voteable()
    {
    	return $this->morphTo();
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function changeRating($count)
    {
        $v = $this->voteable;
        $v->rating += $count;
        $v->save();
        $u = $v->author;
        $u->rating += $count;
        $u->save();
    }
}
