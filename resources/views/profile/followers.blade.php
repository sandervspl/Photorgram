@extends('layouts.master')
@section('title', $user->name . '\'s Followers')
@section('content')
<section class="main-article">
    <div class="list-header rating row">
        <a href="{{ action('ProfileController@show', $user->name) }}">
            <div class="col-xs-2 col-md-1 avatar-container">
                <div class="avatar">
                    <img src="{{ url('uploads/profile/', $user->profile->profile_picture) }}" alt="Avatar">
                </div>
            </div>
        </a>
        <div class="col-xs-7 col-md-8 title">
            <h1>Followers</h1>
        </div>
        <div class="col-xs-2 col-md-3 count">
            <h1>{{ $user->followers()->count() }}</h1>
        </div>
    </div>

    <div class="search-result users scroll">
        @if($followers->count() > 0)
            <div class="row">
                @foreach($followers as $follower)
                    <?php $usr = \App\User::findOrFail($follower->user_id); ?>
                    <div class="col-xs-12 col-md-3">
                        <div class="user-block">
                            <a href="{{ action('ProfileController@show', $usr->name) }}" class="user-card-link">
                                <div class="user-card" title="Profile of {{ $usr->name }}">
                                    <div class="profile-picture">
                                        <img src="{{ url('uploads/profile/', $usr->profile->profile_picture) }}"
                                             alt="avatar">
                                    </div>
                                    <div class="profile-info">
                                        <div class="username"> {{ $usr->name }} </div>
                                        <div class="followers small">
                                            {{ number_format(App\Follow::getFollowersCount($usr->id) * 1035, 0, ',', '.') }} followers
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="hidden text-left">
                {{ $followers->links() }}
            </div>
        @endif
    </div>
</section>
@endsection