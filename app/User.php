<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Follow;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];




    public function images()
    {
        return $this->hasMany('App\Image');
    }


    public function ratings()
    {
        return $this->hasMany('App\Image_Rating');
    }


    public function profile()
    {
        return $this->hasOne('App\Profile');
    }


    public function followers($id)
    {
        return Follow::where('user_id', '=', $id)->get();
    }


    public static function getAllFollowing($user_id)
    {
        return Follow::where('user_id', '=', $user_id)->get();
    }


    public static function isFollowing($id)
    {
        return Follow::where('follow_id', '=', $id)
            ->where('user_id', Auth::id())
            ->first();
    }


    public static function getUserByName($user_name)
    {
        return User::where('name', '=', $user_name)->firstOrFail();
    }


    public static function getAllUsersWithRole($role_id)
    {
        return User::where('role', '=', $role_id)->get();
    }


    public static function getAllUsersWithName($name)
    {
        return User::where('name', 'like', '%'.$name.'%')
            ->where('role', '=', '1')
            ->get();
    }
}