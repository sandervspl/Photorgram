<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    private $p;

    function __construct()
    {
        return $this->p = Config::get('constants.permissions');
    }

    public function update(Request $request)
    {
        if (Auth::id() != $request->get('user_id') && Auth::User()->role < $this->p['update_account'])
            abort(403);

        $user = User::findOrFail($request->get('user_id'));
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        $password = $request->get('password');
        if ( ! is_null($password) && $password != '') {
            $user->password = Hash::make($password);
        }
        $user->save();

        $user = User::findOrFail($request->get('user_id'));

        return Redirect::to(action('ProfileController@show', $user->name));
    }


    public function updateRole(Request $request)
    {
        $user = User::findOrFail($request->get('user_id'));

        $user->role = $request->get('role_id');
        $user->save();

        return Redirect::back();
    }


    public function remove(Request $request)
    {
        $user = User::findOrFail($request->get('user_id'));

        // remove all their images
        foreach ($user->images as $image) {
            $image->delete();
        }

        // remove all their ratings
        foreach ($user->ratings as $rating) {
            $rating->delete();
        }

        // remove their profile
        $user->profile->delete();

        // remove the user itself
        $user->delete();

        return Redirect::to(action('AdminController@index'));
    }
}
