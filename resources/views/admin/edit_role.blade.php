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
                {!! Form::label('name', 'Role*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', $role->name, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                @if ($errors->has('name'))
                <span class="help-block col-sm-offset-2 col-sm-6 error-text">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
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