@extends('layouts.master')
@section('title', 'Image')
@section('content')
    <section class="main-article">
        <div class="text">
            <img src="{{ url('uploads/'.$image->image_uri) }}" alt="image">
        </div>
    </section>
@endsection