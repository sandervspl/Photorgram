<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        // look for user with this name
        $user = User::where('name', '=', $name)->first();

        // if it does not exist, show 404 page
        if (is_null($user)) {
            abort(404);
        }

        return view('profile.index', ['user' => $user]);
    }

    public function showImage($name, $imageid)
    {
        // see if user and image exist before we continue
        $user = User::where('name', '=', $name)->first();
        if (is_null($user)) {
            abort(404);
        }

        // try to get image, if not then abort
        $image = Image::FindOrFail($imageid);

        // make sure image is from this user
        $verify = $user->images->contains($imageid);

        // if not then abort
        if ( ! $verify) {
            abort(404);
        }

        return view('profile.image', ['user' => $user, 'image' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
