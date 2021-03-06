<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'description'];

    public function links()
    {
        return $this->belongsToMany('App\Link')
                    ->withTimestamps();
    }
}
