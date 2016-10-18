<?php

namespace App\Http\Controllers;

use App\Image_Rating;
use Illuminate\Http\Request;
use App\Http\Requests;
use \Storage;
use App\Image;
use App\Category;
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
        $this->allImages();
    }


    public function allImages()
    {
        $categories = Category::all();
        $images = [];

        // get a maximum of 3 images per category
        // store each category as an array in our images array
        foreach ($categories as $category) {
            $temp_array = [];
            $i = 0;

            // start at the latest image
            foreach ($category->images->reverse() as $image) {
                $temp_array[] = $image;

                if (++$i >= 5)
                    break;
            }

            $images[] = $temp_array;
        }

        return view('images.index', [
            'images' => $images,
            'categories' => $categories
        ]);
    }


    public function upload()
    {
        if (Auth::Guest())
            abort(403);

        $categories = Category::all();

        return view('upload.index', compact('categories'));
    }


    public function category($category_name)
    {
        $categories = Category::all();
        $category = Category::getCategoryByName($category_name);
        $images = $category->images;

        return view('images.category', [
            'categoryname' => $category_name,
            'categories' => $categories,
            'images' => $images
        ]);
    }


    public function show($image_name)
    {
        // try to get image
        $image = Image::getImageByName($image_name);

        // check if logged-in user has rated this image and what he rated
        $userHasRated = Image_Rating::userHasRated(Auth::id(), $image->id);

        return view('images.image', [
            'user' => $image->user,
            'image' => $image,
            'userHasRated' => $userHasRated
        ]);
    }


    // Request all information from the form
    public function process(Request $request)
    {
        if (Auth::Guest())
            abort(403);

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
                return Redirect::to(action('ImageController@show', ['imagename' => $image->image_uri]));
            } else {
                abort(503);
            }
        } else {
            return 'No file';
        }

        return abort(503);
    }


    public function edit($image_name)
    {
        if (Auth::Guest())
            abort(403);

        $user = Auth::User();
        $image = Image::getImageByName($image_name);

        $verify = $image->user->id == $user->id || $user->role >= 3;

        // forbidden
        if ( ! $verify)
            abort(403);

        $categories = Category::all();

        return view('images.edit', [
            'image' => $image,
            'categories' => $categories
        ]);
    }


    public function update(Request $request)
    {
        if (Auth::Guest())
            abort(403);

        $image = Image::findOrFail($request->get('id'));
        $image->title = $request->get('title');
        $image->category_id = $request->get('category');
        $image->description = $request->get('description');
        $image->save();

        return Redirect::to(action('ImageController@show', $image->image_uri));
    }


    public function confirmRemove($image_name)
    {
        if (Auth::Guest())
            abort(404);

        $image = Image::getImageByName($image_name);
        $user = Auth::User();

        $verify = $image->user->id == $user->id || $user->role < 3;

        // forbidden
        if ( ! $verify)
            abort(403);

        return view('images.remove', ['image' => $image]);
    }


    public function remove(Request $request)
    {
        if (Auth::Guest())
            abort(404);

        $image = Image::findOrFail($request->get('image_id'));
        $user = Auth::User();

        $verify = $image->user->id == $user->id || $user->role < 3;

        // forbidden
        if ( ! $verify)
            abort(403);

        $image->delete();

        return Redirect::to(action('ProfileController@show', ['user_name' => $user->name]));
    }


    public function ratings($image_name)
    {
        $image = Image::getImageByName($image_name);
        $likes = Image_Rating::getLikesForImage($image->id);
        $dislikes = Image_Rating::getDislikesForImage($image->id);

        return view('images.rating', [
            'image' => $image,
            'likes' => $likes,
            'dislikes' => $dislikes
        ]);
    }
}
