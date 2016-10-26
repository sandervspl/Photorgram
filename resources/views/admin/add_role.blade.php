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
                {!! Form::label('name', 'Role Name*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>

                @if ($errors->has('name'))
                <span class="help-block col-sm-offset-2 col-sm-6 error-text">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
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