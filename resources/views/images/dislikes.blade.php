@extends('layouts.master')
@section('title', 'dislikes')
@section('content')
    <section class="main-article">
        <div class="list-header rating row">
            <a href="{{ action('ImageController@show', $image->image_uri) }}">
                <div class="col-xs-2 col-md-1 avatar-container">
                    <div class="avatar">
                        <img src="{{ url('uploads/', $image->image_uri) }}" alt="Image">
                    </div>
                </div>
            </a>
            <div class="col-xs-7 col-md-8 title">
                <h1>Dislikes</h1>
            </div>
            <div class="col-xs-2 col-md-2 count">
                <h1>{{ $dislikes->count() }}</h1>
            </div>
        </div>

        <div class="search-result users scroll">
            @if($dislikes->count() > 0)
                <div class="row">
                    @foreach($dislikes as $dislike)
                    <?php $user = \App\User::findOrFail($dislike->user_id); ?>
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
                    {{ $dislikes->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection