@extends('layouts.master')
@section('title', 'Image')
@section('content')
    <section class="main-article">
        <div class="profile-header">
            <h1 id="profile-user-name">
                <a href="{{ action('ProfileController@show', ['username' => $user->name]) }}">{{ $user->name }}</a>
            </h1>
            <a class="btn btn-default profile-buttons">Follow</a>
        </div>

        <div class="row">
            <div class="image-body col-md-6">
                <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image" class="col-md-6 image-body-src">
            </div>

            <div class="image-info col-md-6">
                <div class="image-info-header">
                    <h3 class="image-info-title">{{ $image->title }}</h3>

                    @if($user->id === Auth::id())
                        <div id="image-user-buttons">
                            <a href="{{ url('/images/'.$image->image_uri.'/edit') }}" class="btn btn-default" id="image-edit-button">
                                Edit
                            </a>
                            <a href="" class="btn btn-default btn-dark" id="image-remove-button">Remove</a>
                        </div>
                    @endif
                </div>

                <div class="image-info-section">
                    <h4>{{ $image->created_at }}</h4>
                    <h4>{{ ucfirst(trans(App\Category::find($image->category_id)->name)) }}</h4>

                    <div class="image-info-description">
                        <small>Description</small>
                        <div class="description">
                            <pre>{{ $image->description }}</pre>
                        </div>
                    </div>

                    <div class="image-info-rating">
                        <button id="like" class="btn btn-default">Like</button> <span>{{ $image->likes }}</span>
                        <button id="dislike" class="btn btn-default">Dislike</button> <span>{{ $image->dislikes }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection