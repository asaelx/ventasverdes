<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Page extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'slug', 'content', 'cover_id'];

    public function links()
    {
        return $this->hasMany('App\Link');
    }

    public function cover()
    {
        return $this->belongsTo('App\Media', 'cover_id');
    }
}
