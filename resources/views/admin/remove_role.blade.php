@extends('layouts.master')
@section('title', 'Administration - Remove Role')
@section('content')
    <section class="main-article admin-page">
        <h2>Are you sure you want to remove the role "{{ $role->name }}"?</h2>
        {!! Form::open([
                'action' => 'RoleController@remove'
            ])
        !!}

        {!! Form::hidden('role_id', $role->id) !!}

        <a href="{{ action('AdminController@roles') }}" class="btn btn-default">Cancel</a>
        {!! Form::submit('Remove', ['class' => 'btn btn-dark remove-btn']) !!}

        {!! Form::close() !!}
    </section>
@endsection