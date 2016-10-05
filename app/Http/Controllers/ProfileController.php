<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Profile;
use Auth;
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


    public function show($user_name)
    {
        if ($this->forbiddenAccess($user_name))
            abort(404);

        // look for user with this name
        $user = User::getUserByName($user_name);

        // if it does not exist, show 404 page
        if (is_null($user))
            abort(404);

        return view('profile.index', ['user' => $user]);
    }


    public function editAccount($user_name)
    {
        if (Auth::Guest())
            abort(403);

        $profile_user = User::getUserByName($user_name);
        $cur_user = Auth::User();

        if ($cur_user->id != $profile_user->id && $cur_user->role < 4)
            abort(403);

        return view('profile.edit.edit_account', ['user' => $profile_user]);
    }

    public function editProfile($user_name)
    {
        if (Auth::Guest())
            abort(403);

        $profile_user = User::getUserByName($user_name);
        $cur_user = Auth::User();

        if ($cur_user->id != $profile_user->id && $cur_user->role < 4)
            abort(403);

        return view('profile.edit.edit_profile', ['user' => $profile_user]);
    }


    public function update(Request $request)
    {
        $profile = Profile::getProfile($request->get('user_id'));

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

        $user = User::findOrFail($request->get('user_id'));
        return Redirect::to(action('ProfileController@show', $user->name));
    }
}
