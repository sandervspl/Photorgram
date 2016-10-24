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
        // sort a-z
        $users = User::orderBy('name', 'asc')->paginate(10);

        return view('admin.index', compact('users'));
    }


    public function categories()
    {
        // get all categories
        // sort a-z
        $categories = Category::orderBy('name', 'asc')->paginate(10);

        return view('admin.categories', compact('categories'));
    }


    public function roles()
    {
        // get all roles
        // sort a-z
        $roles = Role::orderBy('name', 'asc')->paginate(10);

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

        return view('admin.edit_category', compact('category'));
    }


    public function removeCategory($category_id)
    {
        $category = Category::findOrFail($category_id);

        return view('admin.remove_category', compact('category'));
    }


    public function addRole()
    {
        return view('admin.add_role');
    }


    public function editRole($role_id)
    {
        $role = Role::findOrFail($role_id);

        return view('admin.edit_role', compact('role'));
    }


    public function removeRole($role_id)
    {
        $role = Role::findOrFail($role_id);

        return view('admin.remove_role', compact('role'));
    }


    public function removeUser($user_name)
    {
        $user = User::getUserByName($user_name);

        return view('admin.remove_user', compact('user'));
    }
}
