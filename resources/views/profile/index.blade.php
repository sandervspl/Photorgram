@extends('layouts.master')
@section('title', 'Profile')
@section('content')
    <section class="main-article">
        <div class="profile-header">
            <h1 id="profile-user-name">{{ $user->name }}</h1>
            <button class="btn btn-default" id="profile-follow-button">Follow</button>
        </div>

        <div class="profile-body">
            @foreach($user->images as $image)
                <div class="profile-image-thumbnail">
                    <a href="{{ action('ProfileController@showImage', ['user' => $user->id, 'image' => $image->id]) }}">
                        <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image">
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection