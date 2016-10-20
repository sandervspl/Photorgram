@extends('layouts.master')
@section('title', 'dislikes')
@section('content')
    <section class="main-article">
        <h1>Dislikes</h1>

        <div class="horizontal-list">
            <ul>
                @foreach($dislikes as $dislike)
                    <?php
                    $user = \App\User::findOrFail($dislike->user_id);
                    ?>
                    <li>
                        <a href="{{ action('ProfileController@show', $user->name) }}">
                            <div class="user-card-horizontal-list">
                                <div class="avatar">
                                    <img src="{{ url('uploads/profile/', $user->profile->profile_picture) }}" alt="avatar">
                                </div>
                                <div class="info">
                                    <div class="username">{{ $user->name }}</div>
                                    <div class="followers">{{ $user->followers->count() }} followers</div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection