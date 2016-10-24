<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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




    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
    }


    public function getLikesCount()
    {
        return Image_Rating::getLikesCountForImage($this->id);
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
        $query = '';

        for ($i = 0; $i < count($profiles); $i += 1) {
            if ($i == 0) {
                $query = Image::where('user_id', '=', $profiles[$i]->follow_id);
            } else {
                $query->orWhere('user_id', '=', $profiles[$i]->follow_id);
            }
        }

        return $query->orderBy('created_at', 'desc')->paginate(5);
    }
}
