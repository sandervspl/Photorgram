<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Storage;
use App\Image;
use App\User;
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

    public function result()
    {
        return view('upload.result');
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
        $image->category = $request->get('category');
        $image->description = $request->get('description');
        $image->save();

        return Redirect::to(action('ProfileController@index'));
    }
}
