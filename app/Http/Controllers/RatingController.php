<?php

namespace App\Http\Controllers;

use App\Image;
use App\Rating;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{
    public function rate(Request $request)
    {
        $image_id = $request->get('image_id');
        $rating_id = $request->get('rating_id');
        $rated = $request->get('user_rated');

        if ($rated) {
            if ($rated === $rating_id) {
                // remove rating


            } else {
                // replace rating


            }
        }

        $user = Auth::user();
        $image = Image::findOrFail($image_id);

        $image->ratings()->attach($rating_id, ['user_id' => $user->id]);

        return Redirect::back();
    }

    public function removeRating(Request $request)
    {
        $user = Auth::user();

        $rating = Rating::where('user_id', $user->id)->where('image_id', $request->get('image_id'))->first();
        if ($rating) {
            Rating::destroy($rating->id);
        }

        return Redirect::back();
    }
}
