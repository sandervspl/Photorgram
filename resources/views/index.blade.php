@extends('layouts.master')
@section('title', 'Frontpage')
@section('content')
    <section class="main-article">
        <article>
            <h1>Photorgram</h1>
            <ul>
                <li><a href="{{ url('/login') }}">Sign In</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            </ul>
        </article>
    </section>
@stop