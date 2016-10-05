<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'profile_picture',
        'bio'
    ];

    public static function getProfile($user_id)
    {
        $profile = Profile::where('user_id', '=', $user_id);
        return $profile->firstOrFail();
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
