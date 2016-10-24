@extends('layouts.master')
@section('title', 'Login')
@section('content')
<section class="main-article">
    <h1>Sign In</h1>

    {!! Form::open([
            'url'   => '/login',
            'class' => 'form-horizontal'
        ])
    !!}
    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>

        @if ($errors->has('email'))
            <span class="help-block col-sm-offset-2 col-sm-10 error-text">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>

        @if ($errors->has('password'))
            <span class="help-block col-sm-offset-2 col-sm-10 error-text">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::checkbox('remember', false, '', ['id' => 'remember']) !!}
            {!! Form::label('remember', 'Remember Me') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Sign In', ['class' => 'btn btn-primary']) !!}
            <a href="{{ url('/password/reset') }}" id="forgot-password">Forgot Your Password?</a>
        </div>
    </div>
    {!! Form::close() !!}
</section>
@endsection
