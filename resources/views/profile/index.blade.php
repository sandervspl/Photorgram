<?php $p = Config::get('constants.permissions') ?>
@extends('layouts.master')
@section('title', $user->name)
@section('content')
<section class="main-article">
    @if ($user->banned && Auth::User()->role < $p['see_banned'])
        <h1 id="ban-title">Banned</h1>
        <p>This account has been terminated.</p>
    @else
    <div class="profile-header">
        <div id="profile-user-image">
            @if( ! empty($user->profile->profile_picture))
                <img src="{{ url('uploads/profile/'.$user->profile->profile_picture) }}" alt="profile picture">
            @endif
        </div>
        <div id="profile-user-info-box">
            <?php $class = ($user->banned) ? 'banned' : '' ; ?>
            <h1 id="profile-user-name" class="{{ $class }}">{{ $user->name }}</h1>

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

                @if( ! Auth::Guest() && Auth::User()->role >= $p['admin_controls'])
                <div class="admin-buttons">
                    <p><strong>Admin Controls</strong></p>

                    @if (Auth::User()->role >= $p['edit_profile'])
                    <a href="{{ action('ProfileController@editProfile', $user->name) }}" class="button button-default">
                        Edit Profile
                    </a>
                    @endif

                    @if ( ! Auth::Guest() && Auth::User()->role >= $p['ban_user'])
                    <?php
                        $class = 'button button-default btn-ban';
                        if ($user->banned)
                            $class = 'button button-default btn-unban';
                    ?>

                    <div class="button-inner">
                        <div class="load-spinner ban hidden"></div>
                        <button class="{{ $class }}" id="ban-button"
                                data-userid="{{ $user->id }}" data-isbanned="{{ $user->banned }}">
                            @if ($user->banned)
                                Unban User
                            @else
                                Ban User
                            @endif
                        </button>
                    </div>
                    @endif
                </div>
                @endif
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
    @endif
</section>
<script>
    var banUrl = '{{ route('banUser') }}',
        token  = '{{ csrf_token() }}';
</script>
@endsection