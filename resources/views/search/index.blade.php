@extends('layouts.master')
@section('title', 'Search')
@section('content')
    <section class="main-article">
        <h1>Search Results</h1>
        <h4 class="alt-title">You searched for "{{ $query }}"</h4>

        <div class="article-container">
            <div class="search-result users">
            @if($users->count() > 0)
                <h2>Users</h2>

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
            @endif
            </div>

            <div class="search-result categories">
                @if($categories->count() > 0)
                <h2>Categories</h2>

                <ul>
                @foreach($categories as $category)
                    <li class="search-category" title="Category {{ $category->name }}">
                        <a href="{{ url('/images/category/'.$category->name) }}">
                            {{ ucfirst(trans($category->name)) }}
                        </a>
                    </li>
                @endforeach
                </ul>
                @endif
            </div>

            <div class="search-result images">
                <h2>Images</h2>
                @if($images->count() == 0)
                    <p>There are no images like that, sorry.</p>
                @else
                    @foreach($images as $image)
                    <div class="image-thumbnail" title="Image: {{ $image->title }}">
                        <a href="{{ action('ImageController@show', ['image' => $image->image_uri]) }}">
                            <img src="{{ url('/uploads/'.$image->image_uri) }}" alt="{{ $image->title }}" title="{{ $image->title }}">
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection