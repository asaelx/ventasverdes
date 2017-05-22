<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'footer',
        'favicon_id',
        'logo_id'
    ];

    public function favicon()
    {
        return $this->belongsTo('App\Media', 'favicon_id');
    }

    public function logo()
    {
        return $this->belongsTo('App\Media', 'logo_id');
    }
}
