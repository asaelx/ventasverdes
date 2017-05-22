<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['content', 'product_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function answer()
    {
        return $this->hasOne('App\Answer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
