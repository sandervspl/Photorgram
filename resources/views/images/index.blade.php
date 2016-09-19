@extends('layouts.master')
@section('title', 'All Images')
@section('content')
<section class="main-article">
    <h1>All Images</h1>

    @include('partials/category_dropdown')

    <div class="article-container">
        <div class="row">
            @foreach($categories as $category)
                <div class="category clearfix">
                    <div class="col-md-2">
                        <h3>{{ ucfirst(trans($category->name)) }}</h3>
                    </div>
                    <div class="col-md-10">
                        @for ($i = 0; $i < count($images); $i++)
                            @for ($j = 0; $j < count($images[$i]); $j++)
                                @if(isset($images[$i][$j]) && $images[$i][$j]['category_id'] == $category->id)
                                    <div class="image-thumbnail-small">
                                        <img src="{{ url('/uploads/'.$images[$i][$j]['image_uri']) }}" alt="image">
                                    </div>
                                @endif
                            @endfor
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection