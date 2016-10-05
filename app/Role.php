<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];



    public function users()
    {
        $this->hasMany(User::class);
    }
}
