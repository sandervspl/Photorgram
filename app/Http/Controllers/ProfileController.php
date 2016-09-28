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

    private function forbiddenAccess($user_name)
    {
        return ($user_name == 'administrator');
    }


    public function index()
    {
        $username = Auth::user()->name;

        if ($this->forbiddenAccess($username))
            abort(404);

        return Redirect::to('/'.$username);
    }


    public function show($username)
    {
        if ($this->forbiddenAccess($username))
            abort(404);

        // look for user with this name
        $user = User::getUserByName($username);

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
        if (Auth::Guest())
            abort(403);

        $user = User::findOrFail(Auth::id());

//        if ($user->role == 4) {
//            return view('profile.edit.edit_account', ['user' => Auth::User()]);
//        }

        return view('profile.edit.edit_account', ['user' => $user]);
    }

    public function editProfile()
    {
        if (Auth::Guest())
            abort(403);

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
