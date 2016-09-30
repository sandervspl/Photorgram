@extends('layouts.master')
@section('title', 'Administration - Add New Role')
@section('content')
    <section class="main-article admin-page">
        <h1>Administration - Add New Role</h1>

        <div class="row">
            {!! Form::open([
                    'action' => 'RoleController@add',
                    'class'  => 'form-horizontal'
                ])
            !!}

            <div class="form-group">
                {!! Form::label('role_name', 'Role Name*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('role_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    {!! Form::submit('Add Role', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection