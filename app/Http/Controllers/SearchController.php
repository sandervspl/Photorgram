<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('search');
        $images = Image::getAllImagesWithQuery($query);

        return view('search.index')->with(['images' => $images, 'query' => $query]);
    }

    public function show()
    {
        return view('search.index');
    }
}
