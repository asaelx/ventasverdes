<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'url', 'page_id'];

    public function page()
    {
        return $this->belongsTo('App\Page');
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu')
                    ->withTimestamps();
    }
}
