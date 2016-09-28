<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Image_Rating;
use Illuminate\Http\Request;
use App\Http\Requests;
use \Storage;
use App\Image;
use App\User;
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
                if (++$i >= 5)
                    break;
            }

            $images[] = $temp_array;
        }

        return view('images.index', ['images' => $images, 'categories' => $categories]);
    }


    public function upload()
    {
        if (Auth::Guest())
            abort(403);

        return view('upload.index');
    }


    public function category($categoryname)
    {
        $categories = Category::all();
        $category = Category::getCategoryByName($categoryname);
        $images = $category->images;

        return view('images.category', [
            'categoryname' => $categoryname,
            'categories' => $categories,
            'images' => $images
        ]);
    }


    public function show($imagename)
    {
        // try to get image
        $image = Image::getImageByName($imagename);

        // try to get owner of this image
        $user = User::findOrFail($image->user_id);

        // make sure image is from this user
        $verify = $user->images->contains($image->id);

        // if not then abort
        if ( ! $verify) {
            abort(403);
        }

        // get all total ratings count for image
        $likesAmount = Image_Rating::getLikesCountForImage($image->id);
        $dislikesAmount = Image_Rating::getDislikesCountForImage($image->id);

        // check if logged-in user has rated this image and what he rated
        $userHasRated = Image_Rating::userHasRated(Auth::id(), $image->id);

        // followers count for header
        $followers = Follow::getFollowersCount($user->id);

        return view('images.image', [
            'user' => $user,
            'image' => $image,
            'likes' => $likesAmount,
            'dislikes' => $dislikesAmount,
            'userHasRated' => $userHasRated,
            'followers' => $followers
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


    public function edit($imagename)
    {
        if (Auth::Guest())
            abort(403);

        $user = User::findOrFail(Auth::id());
        $image = Image::getImageByName($imagename);

        $verify = $user->images->contains($image->id);

        // forbidden
        if ( ! $verify) {
            abort(403);
        }

        return view('images.edit')->with('image', $image);
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


    public function ratings($imagename)
    {
        $image = Image::getImageByName($imagename);
        $likes = Image_Rating::getLikesForImage($image->id);
        $dislikes = Image_Rating::getDislikesForImage($image->id);

        return view('images.rating')->with([
            'image' => $image,
            'likes' => $likes,
            'dislikes' => $dislikes
        ]);
    }
}
