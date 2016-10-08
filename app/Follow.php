<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'user_id',
        'follows_id'
    ];

    public static function getFollowersCount($user_id)
    {
        $followers = Follow::where('follow_id', '=', $user_id);
        return ( ! is_null($followers)) ? $followers->count() : 0;
    }
}
