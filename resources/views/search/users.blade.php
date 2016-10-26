@extends('layouts.master')
@section('title', 'Search - Profiles')
@section('content')
<section class="main-article">
    <h1>Search Results</h1>
    <div class="alt-title">You searched for "{{ $query }}"</div>

    <div class="article-container">
        <div class="search-result-nav">
            <h2 class="active">Profiles</h2>
            <a href="{{ action('SearchController@showImages', $query) }}"><h2>Images</h2></a>
            <a href="{{ action('SearchController@showCategories', $query) }}"><h2>Categories</h2></a>
        </div>

        <div class="search-result users scroll">
            @if($users->count() > 0)
                @foreach($users as $user)
                <div class="search-user">
                    <a href="{{ action('ProfileController@show', $user->name) }}" class="user-card-link">
                        <div class="user-card" title="Profile of {{ $user->name }}">
                            <div class="profile-picture">
                                <img src="{{ url('uploads/profile/', $user->profile->profile_picture) }}"
                                     alt="avatar">
                            </div>
                            <div class="profile-info">
                                <div class="username"> {{ $user->name }} </div>
                                <div class="followers small"> {{ App\Follow::getFollowersCount($user->id) }} followers </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

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