<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    public function values()
    {
        return $this->hasMany('App\Value');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')
                    ->withTimestamps();
    }
}
