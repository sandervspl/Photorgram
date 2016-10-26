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
    public function validator($request)
    {
        return $this->validate($request, [
            'name' => 'required|max:255|unique:roles'
        ]);
    }


    public function add(Request $request)
    {
        $this->validator($request);

        Role::create([
            'name' => $request->get('name')
        ]);

        return Redirect::to(action('AdminController@roles'));
    }


    public function editName(Request $request)
    {
        $this->validator($request);

        $role = Role::findOrFail($request->get('role_id'));
        $role->name = $request->get('name');
        $role->save();

        return Redirect::to(action('AdminController@roles'));
    }


    public function remove(Request $request)
    {
        $role = $request->get('role_id');

        // get all users with this role
        $users = User::getAllUsersWithRole($role);

        // update their role to user
        foreach ($users as $user) {
            $user->role = 1;
            $user->save();
        }

        // remove role
        Role::findOrFail($role)->delete();

        return Redirect::to(action('AdminController@roles'));
    }
}
