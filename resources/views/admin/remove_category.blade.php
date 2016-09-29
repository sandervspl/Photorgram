@extends('layouts.master')
@section('title', 'Administration - Remove Category')
@section('content')
    <section class="main-article admin-page">
        <h2>Are you sure you want to remove the category "{{ $category->name }}"?</h2>
        {!! Form::open([
                'action' => 'CategoryController@remove'
            ])
        !!}

        {!! Form::hidden('category_id', $category->id) !!}

        <a href="{{ action('AdminController@categories') }}" class="btn btn-default">Cancel</a>
        {!! Form::submit('Remove', ['class' => 'btn btn-dark remove-btn']) !!}

        {!! Form::close() !!}
    </section>
@endsection