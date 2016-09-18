@extends('layouts.master')
@section('title', 'Upload')
@section('content')
    <section class="main-article">
        @if(Session::get('success') === 0)
            <h1>Image upload failed.</h1>
            <div class="text">Please try again later.</div>
        @else
            <h1>Image successfully uploaded!</h1>
        @endif
    </section>
@endsection