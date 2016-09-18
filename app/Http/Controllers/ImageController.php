<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Storage;
use App\Image;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class ImageController extends Controller
{
    public function index()
    {
        return view('images.index');
    }


    public function upload()
    {
        return view('upload.index');
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
        $success = 0;

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
                $image->category = $request->get('category');
                $image->description = $request->get('description');
                $image->save();

                $success = 1;
            }
        }

        return Redirect::to(action('ImageController@result'))->with('success', $success);
    }

    public function result()
    {
        return view('upload.result');
    }

    public function edit($id)
    {
        $image = Image::find($id);
        return view('images.edit')->with('image', $image);
    }
}
