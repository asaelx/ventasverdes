<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    /**
     * The name of the table.
     * @var string
     */
    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title', 'original_name', 'url', 'type'];

    public function products()
    {
        return $this->belongsToMany('App\Product')
                    ->withTimestamps();
    }

    public function page()
    {
        return $this->hasOne('App\Page', 'cover_id', 'id');
    }

    public function collection()
    {
        return $this->hasOne('App\Collection', 'cover_id', 'id');
    }

    public function characteristic()
    {
        return $this->hasOne('App\Characteristic', 'icon_id', 'id');
    }

    public function favicon_setting()
    {
        return $this->hasOne('App\Media', 'favicon_id', 'id');
    }

    public function logo_setting()
    {
        return $this->hasOne('App\Media', 'logo_id', 'id');
    }
}
