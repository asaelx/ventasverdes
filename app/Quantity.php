<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['quantity', 'variation_id'];

    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    public function variation()
    {
        return $this->belongsTo('App\Variation');
    }
}
