<?php

namespace App\Http\Controllers;

use App\Category;
use App\Role;
use Auth;
use App\User;
use App\Http\Requests;

class AdminController extends Controller
{
    public function index()
    {
        // get all users
        $users = User::all();

        return view('admin.index', ['users' => $users]);
    }


    public function categories()
    {
        $categories = Category::all();

        return view('admin.categories', ['categories' => $categories]);
    }


    public function roles()
    {
        $roles = Role::all();

        return view('admin.roles', compact('roles'));
    }


    public function userRoles($role_id)
    {
        $users = User::getAllUsersWithRole($role_id);

        return view('admin.role', compact('users', 'role_id'));
    }


    public function addCategory()
    {
        return view('admin.add_category');
    }


    public function editCategory($category_id)
    {
        $category = Category::findOrFail($category_id);

        return view('admin.edit_category', ['category' => $category]);
    }


    public function removeCategory($category_id)
    {
        $category = Category::findOrFail($category_id);

        return view('admin.remove_category', ['category' => $category]);
    }


    public function addRole()
    {
        return view('admin.add_role');
    }


    public function editRole($role_id)
    {
        $role = Role::findOrFail($role_id);

        return view('admin.edit_role', ['role' => $role]);
    }


    public function removeRole($role_id)
    {
        $role = Role::findOrFail($role_id);

        return view('admin.remove_role', ['role' => $role]);
    }


    public function removeUser($user_name)
    {
        $user = User::getUserByName($user_name);

        return view('admin.remove_user', ['user' => $user]);
    }
}
