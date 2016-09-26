<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Rating;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Image;
use App\Profile;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username = Auth::user()->name;
        return Redirect::to('/'.$username);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        // look for user with this name
        $user = User::where('name', '=', $name)->first();

        // if it does not exist, show 404 page
        if (is_null($user)) {
            abort(404);
        }

        $followers = Follow::where('follow_id', '=', $user->id)->count();

        return view('profile.index', ['user' => $user, 'followers' => $followers]);
    }

    public function showImage($username, $imagename)
    {
        // see if user and image exist before we continue
        $user = User::where('name', '=', $username)->first();

        if (is_null($user)) {
            abort(404);
        }

        // try to get image
        $image = Image::where('image_uri', '=', $imagename)->first();

        if (is_null($image)) {
            abort(404);
        }

        // make sure image is from this user
        $verify = $user->images->contains($image->id);

        // if not then abort
        if ( ! $verify) {
            abort(403);
        }

        // get all total ratings count for image
        $likesAmount = 0;
        if ($likes = $image->ratings->where('id', '=', '1')) {
            $likesAmount = $likes->count();
        }

        $dislikesAmount = 0;
        if ($dislikes = $image->ratings->where('id', '=', '2')) {
            $dislikesAmount = $dislikes->count();
        }

        // check if logged-in user has rated this image and what he rated
        $userHasRated = DB::table('image_rating')->where([
            ['user_id', '=', Auth::id()],
            ['image_id', '=', $image->id]
        ])->first();


        if ( ! is_null($userHasRated)) {
            $userHasRated = $userHasRated->rating_id;
        } else {
            $userHasRated = 0;
        }

        // followers count for header
        $followers = Follow::where('follow_id', '=', $user->id)->count();

        return view('profile.image', [
            'user' => $user,
            'image' => $image,
            'likes' => $likesAmount,
            'dislikes' => $dislikesAmount,
            'userHasRated' => $userHasRated,
            'followers' => $followers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAccount()
    {
        return view('profile.edit.edit_account');
    }

    public function editProfile()
    {
        return view('profile.edit.edit_profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = Profile::where('user_id', '=', Auth::id())->first();

        // set bio
        $profile->bio = $request->get('bio');

        // set profile picture if included
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // generate file name for database
            $fileName = $this->generateRandomString();

            // create a destination and save to folder
            $destinationPath = config('app.fileDestinationPath').'/profile/'.$fileName;
            $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

            // if correctly uploaded
            // add to database
            if ($uploaded) {
                $profile->profile_picture = $fileName;
            } else {
                echo "upload fail";
            }
        } else {
            echo "no file";
        }

        $profile->save();

        return Redirect::to(action('ProfileController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
