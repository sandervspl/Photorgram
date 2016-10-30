<?php $p = Config::get('constants.permissions') ?>
@extends('layouts.master')
@section('title', 'Administration - Categories')
@section('content')
<section class="main-article admin-page">
    <h1>Administration - Categories</h1>

    <div id="admin-menu">
        <ul>
            @include('partials/admin_menu')

            @if (Auth::User()->role >= $p['add_category'])
            <li class="add-new-category-btn">
                <a href="{{ action('AdminController@addCategory') }}" class="btn btn-default">Add New Category</a>
            </li>
            @endif
        </ul>
    </div>

    @include('partials/admin_search_categories')

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
                    @if (Auth::User()->role >= $p['edit_category'])
                    <a href="{{ action('AdminController@editCategory', ['categoryid' => $category->id]) }}">
                        Edit
                    </a>
                    @else
                        Edit
                    @endif

                    <span> | </span>

                    @if (Auth::User()->role >= $p['remove_category'])
                    <a href="{{ action('AdminController@removeCategory', ['categoryid' => $category->id]) }}" class="remove-link">
                        Remove Category
                    </a>
                    @else
                        Remove Category
                    @endif
                </td>
            </tr>
            <tr class="spacer"></tr>
        @endforeach
    </table>
    <div class="text-center">
        {{ $categories->links() }}
    </div>
</section>
@endsection