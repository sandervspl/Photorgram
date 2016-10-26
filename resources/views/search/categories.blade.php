@extends('layouts.master')
@section('title', 'Search - Profiles')
@section('content')
    <section class="main-article">
        <h1>Search Results</h1>
        <div class="alt-title">You searched for "{{ $query }}"</div>

        <div class="article-container">
            <div class="search-result-nav">
                <a href="{{ action('SearchController@showProfiles', $query) }}"><h2>Profiles</h2></a>
                <a href="{{ action('SearchController@showImages', $query) }}"><h2>Images</h2></a>
                <h2 class="active">Categories</h2>
            </div>

            <div class="search-result categories">
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        <div class="category-item">
                            <a href="{{ url('/images/category/'.$category->name) }}">
                                <div class="search-category" title="Category {{ $category->name }}">
                                    {{ ucfirst(trans($category->name)) }}
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>There are no categories like that, sorry.</p>
                @endif
            </div>
        </div>
    </section>
@endsection