<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];

    public static function getCategoryByName($category_name)
    {
        return Category::where('name', '=', $category_name)->firstOrFail();
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
