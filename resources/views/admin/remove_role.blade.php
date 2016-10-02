@extends('layouts.master')
@section('title', 'Administration - Remove Role')
@section('content')
    <section class="main-article admin-page">
        <div class="warning-box">
            <span>Are you sure you want to remove the role "<b>{{ $role->name }}</b>" ?</span>
        </div>

        {!! Form::open([
                'action' => 'RoleController@remove'
            ])
        !!}

        {!! Form::hidden('role_id', $role->id) !!}

        <a href="{{ action('AdminController@roles') }}" class="btn btn-default">Cancel</a>
        {!! Form::submit('Remove', ['class' => 'btn btn-warning warning-space']) !!}

        {!! Form::close() !!}
    </section>
@endsection