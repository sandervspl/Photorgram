<?php

namespace App\Http\Controllers;

use Auth;
use App\Rating;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{
    public function like(Request $request)
    {
        $user = Auth::user();

        $rating = New Rating;
        $rating->user_id = $user->id;
        $rating->image_id = $request->get('image_id');
        $rating->rating = $request->get('rating');
        $rating->save();

        return Redirect::back();
    }

    public function dislike(Request $request)
    {
        $user = Auth::user();

        $rating = New Rating;
        $rating->user_id = $user->id;
        $rating->image_id = $request->get('image_id');
        $rating->rating = $request->get('rating');
        $rating->save();

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

    //
    // WHY IT NO WORK?
    //

    public function getLikesAmount($imageId)
    {
        return Rating::where('image_id', '=', $imageId)->where('rating', '=', '1')->count();
    }

    public function getDislikesAmount($imageId)
    {
        return Rating::where('image_id', '=', $imageId)->where('rating', '=', '0')->count();
    }
}
