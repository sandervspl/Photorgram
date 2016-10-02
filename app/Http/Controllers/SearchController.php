<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('search');
        $images = Image::getAllImagesWithQuery($query);
        $categories = Category::getAllCategoriesWithName($query);
        $users = User::getAllUsersWithName($query);

        return view('search.index', [
            'images' => $images,
            'query' => $query,
            'categories' => $categories,
            'users' => $users
        ]);
    }

    public function show()
    {
        return view('search.index');
    }
}
