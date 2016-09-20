@extends('layouts.master')
@section('title', $user->name)
@section('content')
<section class="main-article">
    <div class="profile-header">
        <h1 id="profile-user-name">{{ $user->name }}</h1>
        @if(Auth::id() != $user->id)
            <a class="btn btn-default profile-buttons">Follow</a>
        @endif
        <h5 id="profile-followers">100 Followers</h5>
        <div id="profile-bio">{{ $user->bio }}</div>
    </div>

    <div class="profile-body">
        @foreach($user->images as $image)
            <div class="image-thumbnail">
                <a href="{{ action('ProfileController@showImage', ['user' => $user->name, 'image' => $image->image_uri]) }}">
                    <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image">
                </a>
            </div>
        @endforeach
    </div>
</section>
@endsection