@extends('layouts.master')
@section('title', $user->name)
@section('content')
<section class="main-article">
    <div class="profile-header">
        <div id="profile-user-image">
            @if( ! empty($user->profile->profile_picture))
                <img src="{{ url('uploads/profile/'.$user->profile->profile_picture) }}" alt="profile picture">
            @endif
        </div>
        <div id="profile-user-info-box">
            <h1 id="profile-user-name">{{ $user->name }}</h1>

            <div class="follow-button-container">
                @include('partials/following_button')
            </div>

            <div id="profile-more-info">
                <a href="{{ action('ProfileController@followers', $user->name) }}" id="profile-followers">
                    <b>Followers</b>
                    <span class="count" id="followers-count">{{ $user->followers->count() }}</span>
                </a>
                <a href="{{ action('ProfileController@following', $user->name) }}" id="profile-following">
                    <b>Following</b>
                    <span class="count" id="following-count">{{ $user->following->count() }}</span>
                </a>
                <b>Photos</b>
                <span class="count">{{ $user->images->count() }}</span>

                <div id="profile-bio">{{ $user->profile->bio }}</div>
            </div>
        </div>
    </div>

    <div class="profile-body">
        @foreach($user->images->reverse() as $image)
            <div class="image-thumbnail">
                <a href="{{ action('ImageController@show', ['image' => $image->image_uri]) }}">
                    <img src="{{ url('uploads/'.$image->image_uri) }}" alt="{{ $image->title }}" title="{{ $image->title }}">
                </a>
            </div>
        @endforeach
    </div>
</section>
@endsection