<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        return Redirect::to(action('SearchController@showProfiles', $request->get('search')));
    }

    public function showProfiles($query)
    {
        $users = User::getAllUsersWithName($query);

        return view('search.users', compact('query', 'users'));
    }


    public function showImages($query)
    {
        $images = Image::getAllImagesWithQuery($query);

        return view('search.images', compact('query', 'images'));
    }


    public function showCategories($query)
    {
        $categories = Category::getAllCategoriesWithName($query);

        return view('search.categories', compact('query', 'categories'));
    }


    public function adminSearchUsers(Request $request)
    {
        return Redirect::to(action('AdminController@searchShowUsers', $request->get('search')));
    }


    public function adminSearchCategories(Request $request)
    {
        return Redirect::to(action('AdminController@searchShowCategories', $request->get('search')));
    }
}
