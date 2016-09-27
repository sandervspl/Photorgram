@extends('layouts.master')
@section('title', 'Search')
@section('content')
    <section class="main-article">
        <h1>Search Results</h1>
        <h4 class="alt-title">You searched for "{{ $query }}"</h4>

        <div class="article-container">
            <div class="images clearfix">
            @foreach($images as $image)
                <div class="image-thumbnail">
                    <a href="{{ action('ImageController@show', ['image' => $image->image_uri]) }}">
                        <img src="{{ url('/uploads/'.$image->image_uri) }}" alt="{{ $image->title }}" title="{{ $image->title }}">
                    </a>
                </div>
            @endforeach
            @if($images->count() == 0)
                <p>There are no images like that, sorry.</p>
            @endif
            </div>
        </div>
    </section>
@endsection