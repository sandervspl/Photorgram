@extends('layouts.master')
@section('title', $user->name . '\'s Followers')
@section('content')
<section class="main-article">
    <h1>Followers of <a href="{{ action('ProfileController@show', $user->name) }}">{{ $user->name }}</a></h1>

    <div class="follow-list">
        <ul>
        @foreach($followers as $follower)
            <?php
                $usr = \App\User::findOrFail($follower->user_id);
            ?>
            <li>
                <a href="{{ action('ProfileController@show', $usr->name) }}">
                    <div class="user-card-follow-list">
                        <div class="avatar">
                            <img src="{{ url('uploads/profile/', $usr->profile->profile_picture) }}" alt="avatar">
                        </div>
                        <div class="info">
                            <div class="username">{{ $usr->name }}</div>
                            <div class="followers">{{ $usr->followers->count() }} followers</div>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
        </ul>
    </div>
</section>
@endsection