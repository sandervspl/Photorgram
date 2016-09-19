<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Storage;
use App\Image;
use App\User;
use App\category;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function index()
    {
        $this->all();
    }

    public function all()
    {
        $categories = Category::all();
        $images = [];

        // get a maximum of 3 images per category
        // store each category as an array in our images array
        foreach ($categories as $category) {
            $all_img = $category->images;
            $temp_array = [];
            $i = 0;

            foreach ($all_img as $image) {
                $temp_array[] = $image;
                if (++$i >= 3)
                    break;
            }

            $images[] = $temp_array;
        }

        return view('images.index', ['images' => $images, 'categories' => $categories]);
    }


    public function upload()
    {
        return view('upload.index');
    }

    public function category($categoryname)
    {
        $categories = Category::all();
        $category = Category::where('name', '=', $categoryname)->first();
        $images = $category->images;

        return view('images.category', ['categoryname' => $categoryname, 'categories' => $categories, 'images' => $images]);
    }

    public function show($id)
    {
        // get user with id
        // if it does not exist, show 404 page
        $user = User::findOrFail($id);

        // get all user's images
        $images = $user->images;

        return view('profile.index', ['user' => $user, 'images' => $images]);
    }

    // Request all information from the form
    public function process(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = config('app.fileDestinationPath').'/'.$fileName;
            $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

            if ($uploaded) {
                $image = new Image;
                $image->user_id = Auth::id();
                $image->image_uri = $fileName;
                $image->title = $request->get('title');
                $image->category_id = $request->get('category');
                $image->description = $request->get('description');
                $image->save();

                return Redirect::to(action(
                    'ProfileController@showImage',
                    [
                        'name'    => Auth::user()->name,
                        'imageid' => $image->id
                    ]
                ));
            } else {
                abort(503);
            }
        }
    }

    public function edit($id)
    {
        $user = User::find(Auth::id());
        $verify = $user->images->contains($id);

        // forbidden
        if (! $verify) {
            abort(403);
        }

        $image = Image::find($id);
        return view('images.edit')->with('image', $image);
    }

    public function update(Request $request)
    {
        $image = Image::find($request->get('id'));
        $image->title = $request->get('title');
        $image->category_id = $request->get('category');
        $image->description = $request->get('description');
        $image->save();

        return Redirect::to(action('ProfileController@index'));
    }
}
