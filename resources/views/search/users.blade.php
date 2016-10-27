@extends('layouts.master')
@section('title', 'Search - Profiles')
@section('content')
<section class="main-article search">
    <div class="article-container">
        <div class="top">
            <div class="search-result-nav">
                <div class="row">
                    <div class="col-xs-4 item active">
                        <h2>Profiles</h2>
                    </div>
                    <div class="col-xs-4 item">
                        <a href="{{ action('SearchController@showImages', $query) }}"><h2>Images</h2></a>
                    </div>
                    <div class="col-xs-4 item">
                        <a href="{{ action('SearchController@showCategories', $query) }}"><h2>Categories</h2></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-query">Results for "{{ $query }}"</div>

        <div class="search-result users scroll">
            @if($users->count() > 0)
                <div class="row">
                @foreach($users as $user)
                    <div class="col-xs-12 col-md-3">
                        <div class="user-block">
                            <a href="{{ action('ProfileController@show', $user->name) }}" class="user-card-link">
                                <div class="user-card" title="Profile of {{ $user->name }}">
                                    <div class="profile-picture">
                                        <img src="{{ url('uploads/profile/', $user->profile->profile_picture) }}"
                                             alt="avatar">
                                    </div>
                                    <div class="profile-info">
                                        <div class="username"> {{ $user->name }} </div>
                                        <div class="followers small">
                                            {{ number_format(App\Follow::getFollowersCount($user->id) * 1035, 0, ',', '.') }} followers
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>

                <div class="hidden text-left">
                    {{ $users->links() }}
                </div>
            @else
                <p>We could not find any profiles.</p>
            @endif
        </div>
    </div>
</section>
<script src="{{ url('js/jquery.jscroll.min.js') }}"></script>
<script src="{{ url('js/infiniteScroll.js') }}"></script>
@endsection