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

            <h5 id="profile-followers">100 Followers</h5>
        </div>
    </div>

    <div class="row">
        <div class="image-body col-md-6">
            <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image" class="col-md-6 image-body-src">
        </div>

        <div class="image-info col-md-6">
            <div class="image-info-header">
                <h3 class="image-info-title">{{ $image->title }}</h3>

                @if($user->id == Auth::id())
                    <div id="image-user-buttons">
                        <a href="{{ url('/images/'.$image->image_uri.'/edit') }}" class="btn btn-default" id="image-edit-button">
                            Edit
                        </a>
                        <a href="" class="btn btn-default btn-dark" id="image-remove-button">Remove</a>
                    </div>
                @endif
            </div>

            <div class="image-info-section">
                <h4>{{ $image->created_at }}</h4>
                <h4>{{ ucfirst(trans(App\Category::find($image->category_id)->name)) }}</h4>

                <div class="image-info-description">
                    <small>Description</small>
                    <div class="description">
                        <pre>{{ $image->description }}</pre>
                    </div>
                </div>


                <div class="image-info-rating">
                    @if(Auth::Guest())
                        <?php $disabled = 'disabled' ?>
                    @else
                        <?php $disabled = '' ?>
                    @endif

                    {!! Form::open([
                            'action' => 'RatingController@like',
                            'class'  => 'horizontal-form rating-form'
                        ])
                    !!}

                    {!! Form::hidden('image_id', $image->image_uri) !!}
                    {!! Form::hidden('rating', 1) !!}
                    {!! Form::submit('Like', ['class' => 'btn btn-default profile-buttons', $disabled]) !!}

                    {!! Form::close() !!}

                    <span>{{ $likes }}</span>

                    {!! Form::open([
                            'action' => 'RatingController@dislike',
                            'class'  => 'horizontal-form rating-form'
                        ])
                    !!}

                    {!! Form::hidden('image_id', $image->image_uri) !!}
                    {!! Form::hidden('rating', 0) !!}
                    {!! Form::submit('Disike', ['class' => 'btn btn-default profile-buttons', $disabled]) !!}

                    {!! Form::close() !!}

                    <span>{{ $dislikes }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection