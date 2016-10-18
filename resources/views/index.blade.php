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
        <div class="feed-image-card" href="{{ $image->image_uri }}">
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
                        <a href="{{ action('ProfileController@show', ['username' => $image->user->name]) }}">
                            <div class="avatar feed">
                                <img src="{{ url('uploads/profile/'.App\Profile::getProfile($image->user_id)->profile_picture) }}"
                                     alt="Avatar">
                            </div>

                            <h4 class="user feed">
                                {{ $image->user->name }}
                            </h4>
                        </a>
                    </div>
                </div>

                <div class="row info-2">
                    <div class="col-md-4">
                        <h4 class="date feed">{{ time_elapsed_string($image->created_at) }}</h4>
                    </div>
                    <div class="col-md-8">
                        <?php
                        $userHasRated = App\Image_Rating::userHasRated(Auth::id(), $image->id);

                        $disabled = '';
                        if (Auth::Guest()) {
                            $disabled = 'disabled';
                        }

                        if ($userHasRated == '1') {
                            $likedStyle = ' user-liked-sm';
                            $dislikedStyle = '';
                        }
                        elseif ($userHasRated == '2') {
                            $likedStyle = '';
                            $dislikedStyle = ' user-disliked-sm';
                        }
                        else {
                            $likedStyle = '';
                            $dislikedStyle = '';
                        }
                        ?>

                        <div class="image-info-buttons" data-imageid="{{ $image->id }}" data-userrated="{{ $userHasRated }}">
                            <button data-ratingid="1" {{ $disabled }} class="button profile-buttons image-like-btn like-btn{{ $likedStyle }}"></button>

                            <span class="image-like-count">{{ $image->getLikesCount() }}</span>

                            <button data-ratingid="2" {{ $disabled }} class="button profile-buttons image-dislike-btn dislike-btn{{ $dislikedStyle }}"></button>

                            <span class="image-dislike-count">{{ $image->getDislikesCount() }}</span>
                        </div>
                    </div>
                </div>

                <?php
                $totalRates = $image->getLikesCount() + $image->getDislikesCount();
                $likePct = ($totalRates > 0) ? ($image->getLikesCount() / $totalRates) * 100 : 0;
                ?>

                <div class="row info-3">
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                        <div class="rating-bar-bg"></div>
                        <div id="rating-bar-{{ $image->id }}" class="rating-bar" style="width: {{ $likePct }}%;"></div>
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
<script>
    var url = '{{ route('rate') }}',
        token = '{{ csrf_token() }}';
</script>
@stop