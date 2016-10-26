<?php $p = Config::get('constants.permissions') ?>
@extends('layouts.master')
@section('title', $image->title)
@section('content')
<div id="preloads">
    <div id="preload-01"></div>
    <div id="preload-02"></div>
</div>
<section class="main-article">
    <div class="image-container">
        <div class="row">
            <div class="image-body col-xs-12 col-md-6 col-lg-6">
                <img src="{{ url('uploads/'.$image->image_uri) }}" class="col-md-6 image-body-src"
                     alt="{{ $image->title }}" title="{{ $image->title }}">
            </div>

            <div class="image-info col-xs-12 col-md-6 col-lg-6">
                <div class="image-info-header row">
                    <div class="col-xs-12">
                        <div class="image-user-info row">
                            <div class="col-xs-9">
                                <a href="{{ action('ProfileController@show', $user->name) }}">
                                    <div class="image-user-header">
                                        <div class="avatar">
                                            <img src="{{ url('uploads/profile/', $user->profile->profile_picture) }}" alt="avatar">
                                        </div>
                                        <div class="username">{{ $user->name }}</div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xs-3">
                                <div class="followbutton">
                                    @include('partials/following_button')
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        if( ! Auth::Guest() && ($user->id == Auth::id() || Auth::User()->role >= $p['edit_image'])) {
                            $colWidth = 'col-xs-6';
                            $isUserImg = true;
                        }
                        else {
                            $colWidth = 'col-xs-6 col-md-12 col-lg-12';
                            $isUserImg = false;
                        }
                    ?>

                    <div class="{{ $colWidth }}">
                        <h3 class="image-info-title">{{ $image->title }}</h3>
                    </div>

                    @if($isUserImg)
                    <div class="col-xs-6">
                        <div id="image-user-buttons">
                            <a href="{{ action('ImageController@edit', $image->image_uri) }}"
                               class="button button-default" id="image-edit-button">
                                Edit
                            </a>

                            @if (Auth::User()->role >= $p['remove_image'])
                            <a href="{{ action('ImageController@confirmRemove', $image->image_uri) }}"
                               class="button button-default btn-warning" id="image-remove-button">
                                Remove
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <div class="info-divider">

                </div>

                <div class="image-info-section">
                    <div class="date">{{ $image->created_at->format('j F Y') }}</div>

                    <?php
                    $categoryName = App\Category::find($image->category_id);
                    if ($categoryName == null) {
                        $categoryName = 'undefined';
                    } else {
                        $categoryName = $categoryName->name;
                    }
                    ?>
                    <div class="category-name">
                    @if ($categoryName !== 'undefined')
                        <a href="{{ url('/images/category/'.$categoryName) }}">
                            {{ ucfirst(trans($categoryName)) }}
                        </a>
                    @else
                        <span>{{ ucfirst(trans($categoryName)) }}</span>
                    @endif
                    </div>

                    @if ($image->description != null)
                    <div class="image-info-description">
                        <small>Description</small>
                        <div class="description">
                            <p>{{ $image->description }}</p>
                        </div>
                    </div>
                    @endif


                    <?php
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

                    <?php
                    $totalRates = $image->getLikesCount() + $image->getDislikesCount();
                    $likePct = ($totalRates > 0) ? ($image->getLikesCount() / $totalRates) * 100 : 0;
                    ?>

                    <div class="ratings-bar-container">
                        <div class="rating-bar-bg"></div>
                        <div id="rating-bar-{{ $image->id }}" class="rating-bar" style="width: {{ $likePct }}%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var rateUrl = '{{ route('rate') }}',
        token = '{{ csrf_token() }}';
</script>
@endsection