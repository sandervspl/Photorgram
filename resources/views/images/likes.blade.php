@extends('layouts.master')
@section('title', 'likes')
@section('content')
    <section class="main-article">
        <div class="list-header row">
            <a href="{{ action('ImageController@show', $image->image_uri) }}">
                <div class="col-md-1">
                    <div class="avatar">
                        <img src="{{ url('uploads/', $image->image_uri) }}" alt="Image">
                    </div>
                </div>
            </a>
            <div class="col-md-9">
                <h1>Likes</h1>
            </div>
            <div class="col-md-2 count">
                <h1>{{ $likes->count() }}</h1>
            </div>
        </div>

        <div class="horizontal-list">
            <div class="row">
            @foreach($likes as $like)
                <?php
                $user = \App\User::findOrFail($like->user_id);
                ?>
                <div class="col-md-3 horizontal-list-item">
                    <a href="{{ action('ProfileController@show', $user->name) }}">
                        <div class="user-card-horizontal-list">
                            <div class="avatar">
                                <img src="{{ url('uploads/profile/', $user->profile->profile_picture) }}" alt="avatar">
                            </div>
                            <div class="info">
                                <div class="username">{{ $user->name }}</div>
                                <div class="followers">{{ $user->followers->count() }} followers</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </section>
@endsection