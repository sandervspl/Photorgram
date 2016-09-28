@extends('layouts.master')
@section('title', 'Frontpage')
@section('content')
<section class="main-article feed">
    @if (isset($images))
    <div class="feed-images">
        @foreach($images as $image)
            <div class="feed-image">
                <div class="image-thumbnail-big feed">
                    <a href="{{ action('ImageController@show', ['image' => $image->image_uri]) }}">
                        <img src="{{ url('uploads/'.$image->image_uri) }}"  alt="{{ $image->title }}" title="{{ $image->title }}">
                    </a>
                </div>

                <div class="row info-1">
                    <div class="col-md-8">
                        <h2 class="title feed">{{ $image->title }}</h2>
                    </div>
                    <div class="col-md-4 username feed">
                        <div class="avatar feed">
                            <img src="{{ url('uploads/profile/'.App\Profile::getProfile($image->user_id)->profile_picture) }}"
                                 alt="Avatar">
                        </div>
                        <h4 class="user feed">
                            <?php $username = App\User::find($image->user_id)->name ?>
                            <a href="{{ action('ProfileController@show', ['username' => $username]) }}">{{ $username }}</a>
                        </h4>
                    </div>
                </div>

                <div class="row info-2">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <h4 class="date feed">{{ $image->created_at }}</h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <h1>Feed</h1>
    <p>You are not following any profiles!</p>
    @endif
</section>
@stop