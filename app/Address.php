<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mienvio_object_id',
        'state',
        'city',
        'address',
        'address2',
        'zipcode'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function orders()
    {
        return $this->hasMany('Orders');
    }
}
