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
    public function validator($request)
    {
        return $this->validate($request, [
            'name' => 'required|max:255|unique:categories'
        ]);
    }


    public function add(Request $request)
    {
        $this->validator($request);

        $name = $request->get('name');
        $description = $request->get('description');

        Category::create([
            'name' => $name,
            'description' => $description
        ]);

        return Redirect::to(action('AdminController@categories'));
    }


    public function editName(Request $request)
    {
        $this->validator($request);

        $category = Category::findOrFail($request->get('category_id'));
        $category->name = $request->get('name');
        $category->save();

        return Redirect::to(action('AdminController@categories'));
    }


    public function remove(Request $request)
    {
        Category::findOrFail($request->get('category_id'))->delete();

        return Redirect::to(action('AdminController@categories'));
    }
}
