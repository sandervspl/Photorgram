@extends('layouts.master')
@section('title', ucfirst(trans($categoryname)))
@section('content')
<section class="main-article">
    <h1>{{ ucfirst(trans($categoryname)) }}</h1>

    @include('partials/category_dropdown')

    <div class="article-container">
        @foreach($images as $image)
            <div class="image-thumbnail">
                <a href="{{ action('ImageController@show', ['image' => $image->image_uri]) }}">
                    <img src="{{ url('uploads/'.$image->image_uri) }}" alt="{{ $image->title }}" title="{{ $image->title }}">
                </a>
            </div>
        @endforeach
    </div>
</section>
@endsection