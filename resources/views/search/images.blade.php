@extends('layouts.master')
@section('title', 'Search - Profiles')
@section('content')
    <section class="main-article search">
        <div class="article-container">
            <div class="top">
                <div class="search-result-nav">
                    <div class="row">
                        <div class="col-xs-4 item">
                            <a href="{{ action('SearchController@showProfiles', $query) }}"><h2>Profiles</h2></a>
                        </div>
                        <div class="col-xs-4 item active">
                            <h2>Images</h2>
                        </div>
                        <div class="col-xs-4 item">
                            <a href="{{ action('SearchController@showCategories', $query) }}"><h2>Categories</h2></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="search-query">Results for "{{ $query }}"</div>

            <div class="search-result images">
            @if($images->count() > 0)
                @foreach($images as $image)
                <div class="image-thumbnail" title="Image: {{ $image->title }}">
                    <div class="dummy"></div>
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