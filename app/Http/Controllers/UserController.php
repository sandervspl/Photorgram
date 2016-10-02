<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function update(Request $request)
    {
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

        $user->role = $request->get('role');
        $user->save();

        return Redirect::back();
    }


    public function remove(Request $request)
    {
        $user = User::findOrFail($request->get('user_id'));


}
