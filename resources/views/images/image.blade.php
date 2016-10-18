@extends('layouts.master')
@section('title', $image->title)
@section('content')
<section class="main-article">
    <div class="profile-header">
        <div id="profile-user-image">
            @if( ! empty($user->profile->profile_picture))
                <a href="{{ action('ProfileController@show', ['username' => $user->name]) }}">
                    <img src="{{ url('uploads/profile/'.$user->profile->profile_picture) }}" alt="profile picture">
                </a>
            @endif
        </div>
        <div id="profile-user-info-box">
            <h1 id="profile-user-name">
                <a href="{{ action('ProfileController@show', ['username' => $user->name]) }}">
                    {{ $user->name }}
                </a>
            </h1>

            @include('partials/following_button')

            <div id="profile-more-info">
                <a href="#" id="profile-followers"><b>{{ $user->followers->count() }}</b> followers</a>
                <a href="#" id="profile-following"><b>{{ $user->following->count() }}</b> following</a>
                <span id="profile-pictures"><b>{{ $user->images->count() }}</b> photos</span>
            </div>
        </div>
    </div>

    <div class="image-container">
        <div class="row">
            <div class="image-body col-md-6">
                <img src="{{ url('uploads/'.$image->image_uri) }}" class="col-md-6 image-body-src"
                     alt="{{ $image->title }}" title="{{ $image->title }}">
            </div>

            <div class="image-info col-md-6">
                <div class="image-info-header row">
                    <?php
                        if( ! Auth::Guest() && ($user->id == Auth::id() || Auth::User()->role >= 3)) {
                            $colWidth = 'col-md-7';
                            $isUserImg = true;
                        }
                        else {
                            $colWidth = 'col-md-12';
                            $isUserImg = false;
                        }
                    ?>

                    <div class="{{ $colWidth }}">
                        <h3 class="image-info-title">{{ $image->title }}</h3>
                    </div>

                    @if($isUserImg)
                    <div class="col-md-5">
                        <div id="image-user-buttons">
                            <a href="{{ action('ImageController@edit', $image->image_uri) }}"
                               class="btn btn-default" id="image-edit-button">
                                Edit
                            </a>
                            <a href="{{ action('ImageController@confirmRemove', $image->image_uri) }}"
                               class="btn btn-default btn-warning" id="image-remove-button">
                                Remove
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="image-info-section">
                    <h4>{{ $image->created_at->format('j F Y') }}</h4>

                    <?php
                    $categoryName = App\Category::find($image->category_id);
                    if ($categoryName == null) {
                        $categoryName = 'undefined';
                    } else {
                        $categoryName = $categoryName->name;
                    }
                    ?>
                    <h4>
                    @if ($categoryName !== 'undefined')
                        <a href="{{ url('/images/category/'.$categoryName) }}">
                            {{ ucfirst(trans($categoryName)) }}
                        </a>
                    @else
                        <span>{{ ucfirst(trans($categoryName)) }}</span>
                    @endif
                    </h4>

                    <div class="image-info-description">
                        <small>Description</small>
                        <div class="description">
                            <p>{{ $image->description }}</p>
                        </div>
                        <div class="fadeout"></div>
                    </div>


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
                        <span class="image-like-count">{{ $image->getLikesCount() }}</span>

                        <button data-ratingid="2" {{ $disabled }} class="button profile-buttons image-dislike-btn dislike-btn{{ $dislikedStyle }}"></button>
                        <span class="image-dislike-count">{{ $image->getDislikesCount() }}</span>
                    </div>

                    <?php
                    $totalRates = $image->getLikesCount() + $image->getDislikesCount();
                    $likePct = ($totalRates > 0) ? ($image->getLikesCount() / $totalRates) * 100 : 0;
                    ?>

                    <div class="ratings-bar-container">
                        <div class="rating-bar-bg"></div>
                        <div id="rating-bar-{{ $image->id }}" class="rating-bar" style="width: {{ $likePct }}%;"></div>
                    </div>

                    <div class="ratings-link-container">
                        <a href="{{ action('ImageController@ratings', $image->image_uri) }}">Ratings Overview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var url = '{{ route('rate') }}',
        token = '{{ csrf_token() }}';
</script>
@endsection