<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subtotal',
        'service_percentage',
        'shipping_fee',
        'conekta_fee',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo('App\Cart');
    }

    public function quantities()
    {
        return $this->hasMany('App\Quantity');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
