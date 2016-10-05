@extends('layouts.master')
@section('title', 'Edit')
@section('content')
<section class="main-article">
    <h1>Account Settings</h1>

    @if($user->id != Auth::id())
        <div class="warning-box">
            <span>You are now editing the account/profile settings of: <b>{{ $user->name }}</b></span>
        </div>
    @endif

    @include('partials/edit_account_menu')

    {!!
        Form::open([
            'action' => 'UserController@update',
            'class' => 'form-horizontal'
        ])
    !!}

    <div class="form-group">
        {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>

        @if ($errors->has('email'))
            <span class="help-block col-sm-offset-2 col-sm-10 error-text">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('email', $user->email, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>

        @if ($errors->has('email'))
            <span class="help-block col-sm-offset-2 col-sm-10 error-text">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('password', 'New Password', ['class' => 'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        @if ($errors->has('password'))
            <span class="help-block col-sm-offset-2 col-sm-10 error-text">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    {!! Form::hidden('user_id', $user->id) !!}

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
</section>
@endsection