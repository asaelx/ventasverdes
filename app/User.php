<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function collections()
    {
        return $this->hasMany('App\Collection');
    }

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }

    public function boxes()
    {
        return $this->hasMany('App\Box');
    }

    public function medias()
    {
        return $this->belongsToMany('App\Medias')
                    ->withTimestamps();
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
