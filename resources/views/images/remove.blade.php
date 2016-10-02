@extends('layouts.master')
@section('title', 'Remove Image')
@section('content')
<section class="main-article">
    <div class="row">
        <h1>{{ $image->title }}</h1>

        <div class="image-body col-md-3">
            <a href="{{ url('images/'.$image->image_uri) }}">
                <img src="{{ url('uploads/'.$image->image_uri) }}" class="col-md-6 image-body-src" alt="{{ $image->title }}" title="{{ $image->title }}">
            </a>
        </div>

        <div class="image-info col-md-9">
            <h3>Are you sure you want to remove this image?</h3>

            {!! Form::open([
                    'action' => 'ImageController@remove'
                ])
            !!}

            {!! Form::hidden('image_id', $image->id) !!}

            <a href="{{ url('images/'.$image->image_uri) }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Remove', ['class' => 'btn btn-warning warning-space']) !!}

            {!! Form::close() !!}

        </div>
    </div>
</section>
@endsection