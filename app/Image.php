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


    public static function getImageByName($image_name)
    {
        return Image::where('image_uri', '=', $image_name)->firstOrFail();
    }

    public function ratings()
    {
        return $this->belongsToMany('App\Rating');
    }


    // does not work
    public function owner()
    {
        return $this->hasOne('App\User');
    }
}
