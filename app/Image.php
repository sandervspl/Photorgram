<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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




    // does not work
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function ratings()
    {
        return $this->belongsToMany('App\Rating');
    }


    public function getLikesCount()
    {
        return Image_Rating::getLikesForImage($this->id);
    }


    public function getDislikesCount()
    {
        return Image_Rating::getDislikesCountForImage($this->id);
    }


    public static function getImageByName($image_name)
    {
        return Image::where('image_uri', '=', $image_name)->firstOrFail();
    }


    public static function getAllImagesWithQuery($query)
    {
        return Image::where('title', 'like', '%'.$query.'%')
            ->orWhere('description', 'like', '%'.$query.'%')
            ->get();
    }


    public static function getAllImagesFromProfiles($profiles)
    {
        $query = DB::table('images');

        foreach($profiles as $profile) {
            $query->orWhere('user_id', '=', $profile->follow_id);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }
}
