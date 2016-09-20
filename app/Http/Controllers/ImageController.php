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

class ImageController extends Controller
{
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

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

            // generate file name for database
            $fileName = $this->generateRandomString();

            // create a destination and save to folder
            $destinationPath = config('app.fileDestinationPath').'/'.$fileName;
            $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

            // if correctly uploaded
            // add to database
            if ($uploaded) {
                $image = new Image;
                $image->user_id = Auth::id();
                $image->image_uri = $fileName;
                $image->title = $request->get('title');
                $image->category_id = $request->get('category');
                $image->description = $request->get('description');
                $image->save();

                // redirect to image page
                return Redirect::to(action(
                    'ImageController@showImage',
                    [
                        'username'  => Auth::user()->name,
                        'imagename' => $image->image_uri
                    ]
                ));
            } else {
                abort(503);
            }
        } else {
            return 'No file';
        }
    }

    public function edit($imagename)
    {
        $user = User::findOrFail(Auth::id());
        $image = Image::where('image_uri', '=', $imagename)->first();

        if (is_null($image)) {
            abort(404);
        }

        $verify = $user->images->contains($image->id);

        // forbidden
        if (! $verify) {
            abort(403);
        }

        return view('images.edit')->with('image', $image);
    }

    public function update(Request $request)
    {
        $image = Image::findOrFail($request->get('id'));
        $image->title = $request->get('title');
        $image->category_id = $request->get('category');
        $image->description = $request->get('description');
        $image->save();

        return Redirect::to(action('ProfileController@index'));
    }
}
