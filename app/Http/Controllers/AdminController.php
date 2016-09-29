<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    private function userHasAccess()
    {
        if (User::findOrFail(Auth::id())->role < 4)
            abort(403);
    }


    public function index()
    {
        $this->userHasAccess();

        // get all users
        $users = User::all();

        return view('admin.index', ['users' => $users]);
    }


    public function categories()
    {
        $this->userHasAccess();

        $categories = Category::all();

        return view('admin.categories', ['categories' => $categories]);
    }


    public function updateRole(Request $request)
    {
        $this->userHasAccess();

        $user = User::findOrFail($request->get('user_id'));

        $user->role = $request->get('role');
        $user->save();

        return Redirect::back();
    }


    public function addCategory()
    {
        return view('admin.add_category');
    }


    public function editCategory($category_id)
    {
        $this->userHasAccess();

        $category = Category::findOrFail($category_id);
        return view('admin.edit_category', ['category' => $category]);
    }


    public function removeCategory($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('admin.remove_category', ['category' => $category]);
    }
}
