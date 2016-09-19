@extends('layouts.master')
@section('title', $user->name)
@section('content')
    <section class="main-article">
        <div class="profile-header">
            <h1 id="profile-user-name">{{ $user->name }}</h1>
            <button class="btn btn-default" id="profile-follow-button">Follow</button>
            <h5 id="profile-followers">100 Followers</h5>
            <div id="profile-bio">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquid animi atque, consectetur cum distinctio dolor ea eligendi eveniet impedit in ipsum maxime nisi perspiciatis qui quos, repellat, sit voluptatum.</div>
        </div>

        <div class="profile-body">
            @foreach($user->images as $image)
                <div class="image-thumbnail">
                    <a href="{{ action('ProfileController@showImage', ['user' => $user->name, 'image' => $image->id]) }}">
                        <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image">
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection