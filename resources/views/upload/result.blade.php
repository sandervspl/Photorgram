@extends('layouts.master')
@section('title', 'Upload')
@section('content')
    <section class="main-article">
        <h1>Image Upload Result</h1>

        @if(Session::get('success') === 0)
            <div class="text">Image not uploaded.</div>
        @else
            <div class="text">Image uploaded!</div>
        @endif
    </section>
@endsection