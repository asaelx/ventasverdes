<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'company',
        'phone',
        'rfc',
        'clabe',
        'bank'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }
}
