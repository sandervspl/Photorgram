<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    private function userHasAccess()
    {
        if (User::findOrFail(Auth::id())->role < 4)
            abort(403);
    }


    public function add(Request $request)
    {
        $this->userHasAccess();

        $name = $request->get('role_name');

        Role::create([
            'name' => $name
        ]);

        return Redirect::to(action('AdminController@roles'));
    }


    public function editName(Request $request)
    {
        $this->userHasAccess();

        $role = Role::findOrFail($request->get('role_id'));
        $role->name = $request->get('role_name');
        $role->save();

        return Redirect::to(action('AdminController@roles'));
    }


    public function remove(Request $request)
    {
        Role::findOrFail($request->get('role_id'))->delete();

        return Redirect::to(action('AdminController@roles'));
    }
}
