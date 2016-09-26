<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'user_id',
        'image_uri',
        'title',
        'category_id',
        'created_at',
        'updated_at'
    ];

    public function ratings()
    {
        return $this->belongsToMany('App\Rating');
    }
}
