@extends('layouts.master')
@section('title', 'Administration - Add New Category')
@section('content')
    <section class="main-article admin-page">
        <h1>Administration - Add New Category</h1>

        <div class="row">
            {!! Form::open([
                    'action' => 'CategoryController@add',
                    'class'  => 'form-horizontal'
                ])
            !!}

            <div class="form-group">
                {!! Form::label('category_name', 'Category Name*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('category_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6">
                    {!! Form::submit('Add Category', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection