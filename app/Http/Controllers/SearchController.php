<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Requests;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('search');
        $images = Image::getAllImagesWithQuery($query);

        $categories = Category::getAllCategoriesWithQuery($query);

        return view('search.index', [
            'images' => $images,
            'query' => $query,
            'categories' => $categories
        ]);
    }

    public function show()
    {
        return view('search.index');
    }
}
