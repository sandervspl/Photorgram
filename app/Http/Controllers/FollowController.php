<?php

namespace App\Http\Controllers;

use Auth;
use App\Follow;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        if (Auth::Guest())
            abort(403);

        $follow = new Follow;
        $follow->user_id = Auth::id();
        $follow->follow_id = $request->get('follow_id');
        $follow->save();

        return Redirect::back();
    }

    public function unfollow(Request $request)
    {
        if (Auth::Guest())
            abort(403);

        $followid = $request->get('follow_id');
        $follow = Follow::where('user_id', Auth::id())->where('follow_id', $followid)->first();

        if ($follow) {
            Follow::destroy($follow->id);
        }

        return Redirect::back();
    }
}
