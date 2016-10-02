@extends('layouts.master')
@section('title', 'Administration - Remove Category')
@section('content')
    <section class="main-article admin-page">
        <div class="warning-box">
            <span>Are you sure you want to remove the category "<b>{{ $category->name }}</b>" ?</span>
        </div>

        {!! Form::open([
                'action' => 'CategoryController@remove'
            ])
        !!}

        {!! Form::hidden('category_id', $category->id) !!}

        <a href="{{ action('AdminController@categories') }}" class="btn btn-default">Cancel</a>
        {!! Form::submit('Remove', ['class' => 'btn btn-warning warning-space']) !!}

        {!! Form::close() !!}
    </section>
@endsection