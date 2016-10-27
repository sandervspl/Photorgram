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
                        <div class="col-xs-4 item">
                            <a href="{{ action('SearchController@showImages', $query) }}"><h2>Images</h2></a>
                        </div>
                        <div class="col-xs-4 item active">
                            <h2>Categories</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="search-query">Results for "{{ $query }}"</div>

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