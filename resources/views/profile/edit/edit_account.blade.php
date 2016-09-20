<?php $user = Auth::user() ?>
@extends('layouts.master')
@section('title', 'Edit')
@section('content')
<section class="main-article">
    <div class="profile-header">
        <h1>Account Settings</h1>

        @include('partials/edit_account_menu')

        {!! Form::open([
                'action' => 'UserController@update',
                'class' => 'form-horizontal'
            ])
        !!}

        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>

            @if ($errors->has('email'))
                <span class="help-block col-sm-offset-3 col-sm-10 error-text">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('email', $user->email, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>

            @if ($errors->has('email'))
                <span class="help-block col-sm-offset-3 col-sm-10 error-text">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('password', 'New Password', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            @if ($errors->has('password'))
                <span class="help-block col-sm-offset-3 col-sm-10 error-text">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</section>
@endsection