<?php use Carbon\Carbon; ?>
@extends('layouts.master')
@section('title', 'Frontpage')
@section('content')
<section class="main-article feed">
    @if (isset($images))
    <div class="feed-images">
        @foreach($images as $image)
            <div class="feed-image-card">
                <div class="image-thumbnail-big feed">
                    <a href="{{ action('ImageController@show', ['image' => $image->image_uri]) }}">
                        <img src="{{ url('uploads/'.$image->image_uri) }}"  alt="{{ $image->title }}" title="{{ $image->title }}">
                    </a>
                </div>

                <div class="info">
                    <div class="row info-1">
                        <div class="col-md-8">
                            <h3 class="title feed">{{ $image->title or 'Undefined' }}</h3>
                        </div>

                        <div class="col-md-4 username feed">
                            <?php $username = App\User::find($image->user_id)->name ?>
                            <a href="{{ action('ProfileController@show', ['username' => $username]) }}">
                                <div class="avatar feed">
                                    <img src="{{ url('uploads/profile/'.App\Profile::getProfile($image->user_id)->profile_picture) }}"
                                         alt="Avatar">
                                </div>

                                <h4 class="user feed">
                                    {{ $username }}
{{--                                    {{ $image->user->name }}--}}
                                </h4>
                            </a>
                        </div>
                    </div>

                    <div class="row info-2">
                        <div class="col-md-4">
                            <?php
                            $created = new Carbon($image->created_at);
                            $now = Carbon::now();
                            $difference = $created->diffInMinutes($now);
                            $timeSinceCreated = $difference;

                            if ($difference < 1)
                                $timeSinceCreated .= ' minute ago';
                            else if ($difference < 60)
                                $timeSinceCreated .= ' minutes ago';

                            if ($difference > 60)
                                $timeSinceCreated = floor($difference / 60) . ' hours ago';

                            if ($difference > 24*60)
                                $timeSinceCreated = floor($difference / (24*60)) . ' days ago';
                            ?>
                            <h4 class="date feed">{{ $timeSinceCreated }}</h4>
                        </div>
                        <div class="col-md-8">
                            <div class="image-info-rating">
                                <?php
                                $userHasRated = App\Image_Rating::userHasRated(Auth::id(), $image->id);
                                $likes = App\Image_Rating::getLikesCountForImage($image->id);
                                $dislikes = App\Image_Rating::getDislikesCountForImage($image->id);

                                $disabled = '';
                                if (Auth::Guest()) {
                                    $disabled = 'disabled';
                                }

                                if ($userHasRated == '1') {
                                    $likedStyle = ' user-liked';
                                    $dislikedStyle = '';
                                }
                                elseif ($userHasRated == '2') {
                                    $likedStyle = '';
                                    $dislikedStyle = ' user-disliked';
                                }
                                else {
                                    $likedStyle = '';
                                    $dislikedStyle = '';
                                }
                                ?>

                                {!! Form::open([
                                        'action' => 'RatingController@rate',
                                        'class'  => 'horizontal-form rating-form'
                                    ])
                                !!}

                                {!! Form::hidden('image_id', $image->id) !!}
                                {!! Form::hidden('rating_id', 1) !!}
                                {!! Form::hidden('user_rated', $userHasRated) !!}

                                {!! Form::submit('', ['class' => 'btn btn-default profile-buttons image-like-btn like-btn'.$likedStyle, $disabled]) !!}

                                {!! Form::close() !!}

                                <span>{{ $likes }}</span>

                                {!! Form::open([
                                        'action' => 'RatingController@rate',
                                        'class'  => 'horizontal-form rating-form'
                                    ])
                                !!}

                                {!! Form::hidden('image_id', $image->id) !!}
                                {!! Form::hidden('rating_id', 2) !!}
                                {!! Form::hidden('user_rated', $userHasRated) !!}

                                {!! Form::submit('', ['class' => 'btn btn-default profile-buttons image-dislike-btn dislike-btn'.$dislikedStyle, $disabled]) !!}

                                {!! Form::close() !!}

                                <span>{{ $dislikes }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <h1>Feed</h1>
    <p>You are not following any profiles!</p>
    @endif
</section>
@stop