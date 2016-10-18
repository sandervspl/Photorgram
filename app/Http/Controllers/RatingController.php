<?php

namespace App\Http\Controllers;

use App\Image;
use App\Image_Rating;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class RatingController extends Controller
{
    private function userHasAccess()
    {
        if (Auth::User()->role < 4)
            abort(403);
    }

    public function rate(Request $request)
    {
        $image_id = $request->get('image_id');
        $rating_id = $request->get('rating_id');
        $rated = $request->get('user_rated');
        $user = Auth::User();

        if ($rated) {
            // remove rating
            Image_Rating::removeRatingFromUser($user->id, $image_id);

            // only remove rating if we click the same rating button
            if ($rated === $rating_id) {
                return Redirect::back();
            }
        }

        $image = Image::findOrFail($image_id);

        // add to image_rating table
        $image->ratings()->attach($rating_id, ['user_id' => $user->id]);

        return response()->json([
            'image_id' => $request->get('image_id'),
            'rating_id' => $request->get('rating_id'),
            'user_rated' => $request->get('user_rated')
        ]);
    }


    public function remove($rating_id)
    {
        $this->userHasAccess();

        Image_Rating::findOrFail($rating_id)->delete();

        return Redirect::back();
    }
}
