@extends('layouts.master')
@section('title', $user->name . '\'s Following List')
@section('content')
<section class="main-article">
    <h1>Following list of <a href="{{ action('ProfileController@show', $user->name) }}">{{ $user->name }}</a></h1>

    <div class="horizontal-list">
        <ul>
            @foreach($following as $follow)
                <?php
                $usr = \App\User::findOrFail($follow->follow_id);
                ?>
                <li>
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
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endsection