<?php $p = Config::get('constants.permissions') ?>
@extends('layouts.master')
@section('title', $user->name)
@section('content')
<section class="main-article">
    @if ($user->banned && (Auth::Guest() || Auth::User()->role < $p['see_banned']))
        <h1 id="ban-title">Banned</h1>
        <p>This account has been terminated.</p>
    @else
    <div class="profile-header">
        <div class="row">
            <div class="col-xs-3 col-md-2">
                <div id="profile-user-image">
                    <div class="dummy"></div>
                    @if( ! empty($user->profile->profile_picture))
                        <img src="{{ url('uploads/profile/'.$user->profile->profile_picture) }}" alt="profile picture">
                    @endif
                </div>
            </div>

            <div class="col-xs-9 col-md-10">
            <div id="profile-user-info-box">
                <?php $class = ($user->banned) ? 'banned' : '' ; ?>
                <h1 id="profile-user-name" class="{{ $class }}">{{ $user->name }}</h1>

                <div class="follow-button-container">
                    @include('partials/following_button')
                </div>

                <div id="profile-more-info">
                    <div class="big-screen">
                        <a href="{{ action('ProfileController@followers', $user->name) }}" id="profile-followers">
                            <b>Followers</b>
                            <span class="count" id="followers-count">{{ number_format($user->followers->count() * 1035, 0, ',', '.') }}</span>
                        </a>
                        <a href="{{ action('ProfileController@following', $user->name) }}" id="profile-following">
                            <b>Following</b>
                            <span class="count" id="following-count">{{ number_format($user->following->count() * 227, 0, ',', '.') }}</span>
                        </a>
                        <b>Photos</b>
                        <span class="count">{{ $user->images->count() }}</span>

                        <div id="profile-bio">{{ $user->profile->bio }}</div>
                    </div>

                    <div class="small-screen">
                        <div class="row">
                            <div class="col-xs-4">
                            <div class="item">
                                <a href="{{ action('ProfileController@followers', $user->name) }}" id="profile-followers">
                                    <b>Followers</b>
                                    <div class="count" id="followers-count">{{ number_format($user->followers->count() * 1035, 0, ',', '.') }}</div>
                                </a>
                            </div>
                            </div>

                            <div class="col-xs-4">
                            <div class="item">
                                <a href="{{ action('ProfileController@following', $user->name) }}" id="profile-following">
                                    <b>Following</b>
                                    <div class="count" id="following-count">{{ number_format($user->following->count() * 227, 0, ',', '.') }}</div>
                                </a>
                            </div>
                            </div>

                            <div class="col-xs-4">
                            <div class="item">
                                <b>Photos</b>
                                <div class="count">{{ $user->images->count() }}</div>
                            </div>
                            </div>
                        </div>

                        <div id="profile-bio">{{ $user->profile->bio }}</div>
                    </div>

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
        </div>
    </div>

    <div class="profile-body">
        @foreach($user->images->reverse() as $image)
            <div class="image-thumbnail">
                <div class="dummy"></div>
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