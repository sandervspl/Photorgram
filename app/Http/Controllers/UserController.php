<?php

namespace App\Http\Controllers;

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
        $user = User::findOrFail(Auth::id());
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        $password = $request->get('password');
        if ( ! is_null($password) || ! isEmpty($password) || $password != '') {
            $user->password =Hash::make($password);
        }

        $user->save();

        return Redirect::to(action('ProfileController@index'));
    }
}
