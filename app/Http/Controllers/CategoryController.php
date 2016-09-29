<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    private function userHasAccess()
    {
        if (User::findOrFail(Auth::id())->role < 4)
            abort(403);
    }


    public function add(Request $request)
    {
        $this->userHasAccess();

        $name = $request->get('category_name');
        $description = $request->get('description');

        Category::create([
            'name' => $name,
            'description' => $description
        ]);

        return Redirect::to(action('AdminController@categories'));
    }


    public function editName(Request $request)
    {
        $this->userHasAccess();

        $category = Category::findOrFail($request->get('category_id'));
        $category->name = $request->get('category_name');
        $category->save();

        return Redirect::to(action('AdminController@categories'));
    }


    public function remove(Request $request)
    {
        Category::findOrFail($request->get('category_id'))->delete();

        return Redirect::to(action('AdminController@categories'));
    }
}
