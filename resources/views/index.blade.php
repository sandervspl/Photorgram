<?php
    include_once 'php/main.php';
?>
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
                        <div class="col-md-8 title">
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
                                    {{--{{ $image->user->name }}--}}
                                </h4>
                            </a>
                        </div>
                    </div>

                    <div class="row info-2">
                        <div class="col-md-4">
                            <h4 class="date feed">{{ time_elapsed_string($image->created_at) }}</h4>
                        </div>
                        <div class="col-md-8">
                            <div class="image-info-buttons">
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

                    <?php
                    $totalRates = $likes + $dislikes;
                    $likePct = ($totalRates > 0) ? ($likes / $totalRates) * 100 : 0;
                    ?>

                    <div class="row info-3">
                        <div class="col-md-7"></div>
                        <div class="col-md-5">
                            <div class="rating-bar-bg"></div>
                            <div class="rating-bar" style="width: {{ $likePct }}%;"></div>
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