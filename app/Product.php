<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Sluggable;
    use Searchable;

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
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return array_only($this->toArray(), ['id', 'title']);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'description', 'user_id'];

    public function variations()
    {
        return $this->belongsToMany('App\Variation')
                    ->withTimestamps();
    }

    public function options()
    {
        return $this->belongsToMany('App\Option')
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category')
                    ->withTimestamps();
    }

    public function characteristics()
    {
        return $this->belongsToMany('App\Characteristic')
                    ->withTimestamps();
    }

    public function medias()
    {
        return $this->belongsToMany('App\Media')
                    ->withTimestamps();
    }

    public function quantities()
    {
        return $this->hasMany('App\Quantity');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    /**
     * Get a list of the categories associated with the current product
     *
     * @return array
     */
    public function getCategoryListAttribute()
    {
        return $this->categories->pluck('id')->all();
    }

    /**
     * Get a list of the characteristics associated with the current product
     *
     * @return array
     */
    public function getCharacteristicListAttribute()
    {
        return $this->characteristics->pluck('id')->all();
    }

}
