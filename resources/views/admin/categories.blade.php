@extends('layouts.master')
@section('title', 'Administration - Categories')
@section('content')
<section class="main-article admin-page">
    <h1>Administration - Categories</h1>

    <div id="edit-account-menu">
        <ul>
            <li><a href="{{ action('AdminController@index') }}" class="btn btn-default">Users</a></li>
            <li><a href="{{ action('AdminController@categories') }}" class="btn btn-default">Categories</a></li>
            <li class="add-new-category-btn"><a href="#" class="btn btn-default">Add New Category</a></li>
        </ul>
    </div>

</section>
@endsection