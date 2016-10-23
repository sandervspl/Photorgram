@extends('layouts.master')
@section('title', $user->name . '\'s Followers')
@section('content')
<section class="main-article">
    <div class="list-header row">
        <a href="{{ action('ProfileController@show', $user->name) }}">
            <div class="col-md-1">
                <div class="avatar">
                    <img src="{{ url('uploads/profile/', $user->profile->profile_picture) }}" alt="Avatar">
                </div>
            </div>
        </a>
        <div class="col-md-9">
            <h1>Followers</h1>
        </div>
        <div class="col-md-2 count">
            <h1>{{ $user->followers()->count() }}</h1>
        </div>
    </div>

    <div class="horizontal-list">
        <div class="row">
        @foreach($followers as $follower)
            <?php
                $usr = \App\User::findOrFail($follower->user_id);
            ?>
            <div class="col-md-3 horizontal-list-item">
                <a href="{{ action('ProfileController@show', $usr->name) }}">
                    <div class="user-card-horizontal-list">
                        <div class="avatar">
                            <img src="{{ url('uploads/profile/', $usr->profile->profile_picture) }}" alt="avatar">
                        </div>
                        <div class="info">
                            <div class="username">{{ $usr->name }}</div>
                            <div class="followers">{{ $usr->followers->count() }} followers</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        </div>
    </div>
</section>
@endsection