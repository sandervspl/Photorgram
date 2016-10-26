@extends('layouts.master')
@section('title', 'Search - Profiles')
@section('content')
    <section class="main-article">
        <h1>Search Results</h1>
        <div class="alt-title">You searched for "{{ $query }}"</div>

        <div class="article-container">
            <div class="search-result-nav">
                <a href="{{ action('SearchController@showProfiles', $query) }}"><h2>Profiles</h2></a>
                <h2 class="active">Images</h2>
                <a href="{{ action('SearchController@showCategories', $query) }}"><h2>Categories</h2></a>
            </div>

            <div class="search-result images">
                @if($images->count() > 0)
                    @foreach($images as $image)
                    <div class="image-thumbnail" title="Image: {{ $image->title }}">
                        <a href="{{ action('ImageController@show', ['image' => $image->image_uri]) }}">
                            <img src="{{ url('/uploads/'.$image->image_uri) }}" alt="{{ $image->title }}" title="{{ $image->title }}">
                        </a>
                    </div>
                    @endforeach

                    <div class="text-left">
                        {{ $images->links() }}
                    </div>
                @else
                    <p>There are no images like that, sorry.</p>
                @endif
            </div>
        </div>
    </section>
@endsection