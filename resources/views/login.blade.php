@extends('layouts.master')
@section('title', 'Login')
@section('content')
<section class="main-article">
    <div class="login-form">
        <form action="">
            <label for="login-username">
                Username
                <input type="text" id="login-username">
            </label> <br/>
            <label for="login-password">
                Password
                <input type="password" id="login-password">
            </label> <br/>
        </form>
    </div>
</section>
@stop