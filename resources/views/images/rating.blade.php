@extends('layouts.master')
@section('title', 'Ratings')
@section('content')
<section class="main-article">
    <h1>Ratings</h1>

    <div class="row">
        <div class="image-body col-md-3">
            <a href="{{ url('images/'.$image->image_uri) }}">
                <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image" class="col-md-6 image-body-src">
            </a>
        </div>

        <div class="image-info col-md-9">
            <div class="row">
                <div class="col-md-6 ratings-like">
                    <h2 class="title-like">Likes</h2>
                    <ul>
                    @if( ! is_null($likes))
                        @foreach($likes as $like)
                            <?php $username = App\User::find($like->user_id)->name; ?>
                            <li>
                                <a href="{{ url('/'.$username) }}">{{ $username }}</a>
                            </li>
                        @endforeach
                    @endif
                    </ul>
                </div>
                <div class="col-md-6 ratings-dislike">
                    <h2 class="title-dislike">Dislikes</h2>
                    <ul>
                    @if( ! is_null($dislikes))
                        @foreach($dislikes as $dislike)
                            <?php $username = App\User::find($dislike->user_id)->name; ?>
                            <li>
                                <a href="{{ url('/'.$username) }}">{{ $username }}</a>
                            </li>
                        @endforeach
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection