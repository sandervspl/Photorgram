@extends('layouts.master')
@section('title', 'Administration - Edit Category')
@section('content')
    <section class="main-article admin-page">
        <h1>Administration - Edit Role</h1>
        <h4 class="alt-title">{{ $role->name }}</h4>

        <div class="row">
            {!! Form::open([
                    'action' => 'RoleController@editName',
                    'class'  => 'form-horizontal'
                ])
            !!}

            {!! Form::hidden('role_id', $role->id) !!}

            <div class="form-group">
                {!! Form::label('role_name', 'Role*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('role_name', $role->name, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection