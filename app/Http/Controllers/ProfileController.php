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


    public function index()
    {
        $username = Auth::user()->name;
        return Redirect::to('/'.$username);
    }


    public function show($name)
    {
        // look for user with this name
        $user = User::where('name', '=', $name)->first();

        // if it does not exist, show 404 page
        if (is_null($user)) {
            abort(404);
        }

        $followers = Follow::getFollowersCount($user->id);

        return view('profile.index', [
            'user' => $user,
            'followers' => $followers
        ]);
    }


    public function editAccount()
    {
        return view('profile.edit.edit_account');
    }

    public function editProfile()
    {
        return view('profile.edit.edit_profile');
    }


    public function update(Request $request)
    {
        $profile = Profile::getProfile(Auth::id());

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
}
