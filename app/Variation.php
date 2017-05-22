<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'title',
        'regular_price',
        'sale_price',
        'stock',
        'length',
        'height',
        'width',
        'weight'
    ];

    public function product()
    {
        return $this->belongsToMany('App\Product')
                ->withTimestamps();
    }
}
