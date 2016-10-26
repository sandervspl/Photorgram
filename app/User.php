<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        return $this->hasMany(Image::class);
    }


    public function ratings()
    {
        return $this->hasMany(Image_Rating::class);
    }


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    public function following()
    {
        return $this->hasMany(Follow::class);
    }


    public function followers()
    {
        return $this->hasMany(Follow::class, 'follow_id', 'id');
    }


    public function role()
    {
        return $this->hasOne(Role::class);
    }




    public static function isFollowing($user_id)
    {
        return Follow::where('follow_id', '=', $user_id)
            ->where('user_id', Auth::id())
            ->first();
    }


    public static function getUserByName($user_name)
    {
        return User::where('name', '=', $user_name)->firstOrFail();
    }


    public static function getAllUsersWithRole($role_id)
    {
        return User::where('role', '=', $role_id)
            ->orderBy('name', 'asc')
            ->paginate(15);
    }


    public static function getAllUsersWithName($user_name)
    {
        return User::where('name', 'like', '%'.$user_name.'%')
            ->where('role', '=', '1')
            ->orderBy('name', 'asc')
            ->paginate(15);
    }

    // check if user has any of the given roles
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }


    public function hasRole($role_id) {
        if ($this->role == $role_id) {
            return true;
        }

        return false;
    }
}