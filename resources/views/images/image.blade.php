@extends('layouts.master')
@section('title', 'Image')
@section('content')
<section class="main-article">
    <div class="profile-header">
        <div id="profile-user-image">
            @if( ! empty($user->profile->profile_picture))
                <img src="{{ url('uploads/profile/'.$user->profile->profile_picture) }}" alt="profile picture">
            @endif
        </div>
        <div id="profile-user-info-box">
            <h1 id="profile-user-name">
                <a href="{{ action('ProfileController@show', ['username' => $user->name]) }}">{{ $user->name }}</a>
            </h1>

            @include('partials/following_button')

            <div id="profile-more-info">
                <h4 id="profile-followers"><b>{{ $followers }}</b> followers</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="image-body col-md-6">
            <img src="{{ url('uploads/'.$image->image_uri) }}" class="col-md-6 image-body-src" alt="{{ $image->title }}" title="{{ $image->title }}">
        </div>

        <div class="image-info col-md-6">
            <div class="image-info-header">
                <h3 class="image-info-title">{{ $image->title }}</h3>

                @if($user->id == Auth::id() || App\User::find(Auth::id())->role >= 3)
                    <div id="image-user-buttons">
                        <a href="{{ action('ImageController@edit', $image->image_uri) }}" class="btn btn-default" id="image-edit-button">
                            Edit
                        </a>
                        <a href="{{ action('ImageController@confirmRemove', $image->image_uri) }}" class="btn btn-default btn-warning" id="image-remove-button">
                            Remove
                        </a>
                    </div>
                @endif
            </div>

            <div class="image-info-section">
                <h4>{{ $image->created_at }}</h4>

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
                    <a href="{{ url('/images/category/'.$categoryName) }}">{{ ucfirst(trans($categoryName)) }}</a>
                    @else
                    <span>{{ ucfirst(trans($categoryName)) }}</span>
                    @endif
                </h4>

                <div class="image-info-description">
                    <small>Description</small>
                    <div class="description">
                        <pre>{{ $image->description }}</pre>
                    </div>
                    <div class="fadeout"></div>
                </div>


                <div class="image-info-rating">
                    @if (Auth::Guest())
                        <?php $disabled = 'disabled' ?>
                    @else
                        <?php $disabled = '' ?>
                    @endif

                    @if ($userHasRated == '1')
                        <?php $likedStyle = ' user-liked'; $dislikedStyle = ''; ?>
                    @elseif ($userHasRated == '2')
                        <?php $likedStyle = ''; $dislikedStyle = ' user-disliked'; ?>
                    @else
                        <?php $likedStyle = ''; $dislikedStyle = ''; ?>
                    @endif

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

                    <div class="ratings-link-container">
                        <a href="{{ action('ImageController@ratings', $image->image_uri) }}">Ratings Overview</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection