<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image_Rating extends Model
{
    // don't use plural name for database tabel
    protected $table = 'image_rating';

    protected $fillable = [
        'image_id',
        'rating_id',
        'user_id'
    ];




    public static function getRatingFromUser($user_id, $image_id)
    {
        return Image_Rating::where([
            ['user_id', '=', $user_id],
            ['image_id', '=', $image_id]
        ])->firstOrFail();
    }


    public static function removeRatingFromUser($user_id, $image_id)
    {
        return self::getRatingFromUser($user_id, $image_id)->delete();
    }


    public static function userHasRated($user_id, $image_id)
    {
        $rating = Image_Rating::where([
            ['user_id', '=', $user_id],
            ['image_id', '=', $image_id]
        ])->first();

        return ( ! is_null($rating)) ? $rating->rating_id : 0;
    }


    public static function getLikesCountForImage($image_id)
    {
        $ratings = Image_Rating::where([
            ['image_id', '=', $image_id],
            ['rating_id', '=', '1']
        ]);
        return ( ! is_null($ratings)) ? $ratings->count() : 0;
    }


    public static function getDislikesCountForImage($image_id)
    {
        $ratings = Image_Rating::where([
            ['image_id', '=', $image_id],
            ['rating_id', '=', '2']
        ]);
        return ( ! is_null($ratings)) ? $ratings->count() : 0;
    }


    public static function getLikesForImage($image_id)
    {
        return $ratings = Image_Rating::where([
            ['image_id', '=', $image_id],
            ['rating_id', '=', '1']
        ])->get();
    }


    public static function getDislikesForImage($image_id)
    {
        return $ratings = Image_Rating::where([
            ['image_id', '=', $image_id],
            ['rating_id', '=', '2']
        ])->get();
    }
}
