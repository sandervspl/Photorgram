@extends('layouts.master')
@section('title', 'Ratings')
@section('content')
<section class="main-article">
    <h1>Ratings</h1>
    <div class="row">
        <div class="image-body col-md-3">
            <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image" class="col-md-6 image-body-src">
        </div>

        <div class="image-info col-md-9">
            <ul>
            @foreach($image->ratings as $rating)
                <li>{{ $rating->id }}</li>
            @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection