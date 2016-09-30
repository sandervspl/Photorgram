@extends('layouts.master')
@section('title', 'Administration - Categories')
@section('content')
<section class="main-article admin-page">
    <h1>Administration - Categories</h1>

    <div id="edit-account-menu">
        <ul>
            <li><a href="{{ action('AdminController@index') }}" class="btn btn-default">Users</a></li>
            <li><a href="{{ action('AdminController@roles') }}" class="btn btn-default">Roles</a></li>
            <li><a href="{{ action('AdminController@categories') }}" class="btn btn-default">Categories</a></li>
            <li class="add-new-category-btn">
                <a href="{{ action('AdminController@addCategory') }}" class="btn btn-default">Add New Category</a>
            </li>
        </ul>
    </div>

    <table>
        <tr>
            <th>Category</th>
            <th>Description</th>
            <th>Manage</th>
        </tr>
        @foreach($categories as $category)
            <tr class="users-data">
                <td> {{ $category->name }} </td>

                <td> {{ $category->description }} </td>

                <td>
                    <a href="{{ action('AdminController@editCategory', ['categoryid' => $category->id]) }}">
                        Edit
                    </a>

                    <span> | </span>

                    <a href="{{ action('AdminController@removeCategory', ['categoryid' => $category->id]) }}" class="remove-link">
                        Remove Category
                    </a>
                </td>
            </tr>
            <tr class="spacer"></tr>
        @endforeach
    </table>

</section>
@endsection