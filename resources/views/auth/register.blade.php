@extends('layouts.master')
@section('title', 'Register')
@section('content')
<section class="main-article">
    <h1>Register</h1>

    {!! Form::open([
            'url'   => '/register',
            'class' => 'form-horizontal'
        ])
    !!}
    <div class="form-group">
        {!! Form::label('name', 'Username', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>

        @if ($errors->has('name'))
            <span class="help-block col-sm-offset-2 error-text">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-Mail', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>

        @if ($errors->has('email'))
            <span class="help-block col-sm-offset-2 error-text">
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
            <span class="help-block col-sm-offset-2 error-text">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('password-confirm', 'Confirm Password', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password-confirm', ['class' => 'form-control', 'name' => 'password_confirmation', 'required' => 'required']) !!}
        </div>

        @if ($errors->has('password_confirmation'))
            <span class="help-block col-sm-offset-2 error-text">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</section>
@endsection
