<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image_Rating extends Model
{
    protected $fillable = [
        'image_id',
        'rating_id',
        'user_id'
    ];
}
