<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'image_id',
        'rating'
    ];

    //
    // WHY IT NO WORK?
    //

    public function getLikesAmount($imageId)
    {
        return $this->where('image_id', '=', $imageId)->where('rating', '=', '1')->count();
    }

    public function getDislikesAmount($imageId)
    {
        return $this->where('image_id', '=', $imageId)->where('rating', '=', '0')->count();
    }
}
