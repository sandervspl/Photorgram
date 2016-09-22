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

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
