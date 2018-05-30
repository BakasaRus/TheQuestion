<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($identifier) {
        return User::orWhere('email', $identifier)->where('is_banned', false)->first();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'author_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function subscribers()
    {
        return $this->morphMany(Subscription::class, 'subscribeable');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
