@extends('layouts.master')
@section('title', 'Administration - Remove User')
@section('content')
    <section class="main-article admin-page">
        <div class="warning-box">
            <span>Are you sure you want to remove the user "<b>{{ $user->name }}</b>" ?</span>
            <p>This will also remove all his <b>images</b> and <b>ratings.</b></p>
        </div>

        {!! Form::open([
                'action' => 'UserController@remove'
            ])
        !!}

        {!! Form::hidden('user_id', $user->id) !!}

        <a href="{{ action('AdminController@index') }}" class="btn btn-default">Cancel</a>
        {!! Form::submit('Remove', ['class' => 'btn btn-warning warning-space']) !!}

        {!! Form::close() !!}
    </section>
@endsection