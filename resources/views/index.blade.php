<?php
    include_once 'php/main.php';
?>
@extends('layouts.master')
@section('title', 'Frontpage')
@section('content')
<div id="preloads">
    <div class="preload"><img src="{{ url('img/like_heart_full.png') }}"></div>
    <div class="preload"><img src="{{ url('img/dislike_heart_full.png') }}"></div>
</div>
<section class="main-article feed">
    @if (isset($images))
    <div class="feed-images scroll">
    @foreach($images as $image)
        <div class="feed-image-card" href="{{ $image->image_uri }}">
            <div class="image-thumbnail-big feed">
                <a href="{{ action('ImageController@show', ['image' => $image->image_uri]) }}">
                    <img src="{{ url('uploads/'.$image->image_uri) }}"  alt="{{ $image->title }}" title="{{ $image->title }}">
                </a>
            </div>

            <div class="container-fluid info">
                <div class="row info-1">
                    <div class="col-xs-7 title">
                        <h3 class="title feed">{{ $image->title or 'Undefined' }}</h3>
                    </div>

                    <div class="col-xs-5 username feed">
                        <a href="{{ action('ProfileController@show', ['username' => $image->user->name]) }}">
                            <div class="avatar-name-container">
                                <div class="avatar feed">
                                    <img src="{{ url('uploads/profile/'.App\Profile::getProfile($image->user_id)->profile_picture) }}"
                                         alt="Avatar">
                                </div>

                                <span class="user feed">
                                    {{ $image->user->name }}
                                </span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row info-2">
                    <div class="col-xs-2">
                        <span class="date feed">{{ time_elapsed_string($image->created_at) }}</span>
                    </div>
                    <div class="col-xs-10">
                        <?php
                        $userHasRated = App\Image_Rating::userHasRated(Auth::id(), $image->id);

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

                        <div class="image-info-buttons" data-imageid="{{ $image->id }}" data-userrated="{{ $userHasRated }}">
                            <button data-ratingid="1" {{ $disabled }} class="button profile-buttons image-like-btn like-btn{{ $likedStyle }}"></button>
                            <a href="{{ action('ImageController@likesOverview', $image->image_uri) }}" class="image-like-count">
                                {{ $image->getLikesCount() }} likes
                            </a>

                            <button data-ratingid="2" {{ $disabled }} class="button profile-buttons image-dislike-btn dislike-btn{{ $dislikedStyle }}"></button>
                            <a href="{{ action('ImageController@dislikesOverview', $image->image_uri) }}" class="image-dislike-count">
                                {{ $image->getDislikesCount() }} dislikes
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                $totalRates = $image->getLikesCount() + $image->getDislikesCount();
                $likePct = ($totalRates > 0) ? ($image->getLikesCount() / $totalRates) * 100 : 0;
                ?>

                <div class="row info-3">
                    <div class="col-sm-5 col-md-4"></div>
                    <div class="col-xs-11 col-sm-7 col-md-8">
                        <div class="rating-bar-bg"></div>
                        <div id="rating-bar-{{ $image->id }}" class="rating-bar" style="width: {{ $likePct }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

        <div class="hidden text-center">
            {{ $images->links() }}
        </div>
    </div>
    @else
    <h1>Feed</h1>
    <p>You are not following any profiles!</p>
    @endif
</section>
<script src="{{ url('js/jquery.jscroll.min.js') }}"></script>
<script>
    var rateUrl = '{{ route('rate') }}',
        token = '{{ csrf_token() }}';
</script>
@stop