<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    private function userHasAccess()
    {
        return (User::findOrFail(Auth::id())->role == 4);
    }


    public function index()
    {
        if ( ! $this->userHasAccess())
            abort(403);

        // get all users
        $users = User::all();

        return view('admin.index')->with('users', $users);
    }


    public function categories()
    {
        if ( ! $this->userHasAccess())
            abort(403);

        return view('admin.categories');
    }


    public function updateRole(Request $request)
    {
        $user = User::findOrFail($request->get('user_id'));

        $user->role = $request->get('role');
        $user->save();

        return Redirect::back();
    }
}
