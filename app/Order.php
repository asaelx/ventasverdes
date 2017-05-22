<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'tracking_number',
        'tracking_url',
        'label_url',
        'delivery_date',
        'payment_method',
        'status',
        'address_id',
        'cart_id'
    ];

    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }
}
