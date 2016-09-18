@extends('layouts.master')
@section('title', 'Image')
@section('content')
    <section class="main-article">
        <div class="profile-header">
            <h1 id="profile-user-name">
                <a href="{{ url('profile/'.$user->id) }}">{{ $user->name }}</a>
            </h1>
            <button class="btn btn-default" id="profile-follow-button">Follow</button>
        </div>

        <div class="row">
            <div class="image-body col-md-6">
                <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image" class="col-md-6 image-body-src">
            </div>

            <div class="image-info col-md-6">
                <div class="image-info-header">
                    <h1>{{ $image->title }}</h1>
                </div>

                <div class="image-info-section">
                    <h4>{{ $image->created_at }}</h4>
                    <h4>{{ $image->category }}</h4>

                    <div class="image-info-rating">

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection