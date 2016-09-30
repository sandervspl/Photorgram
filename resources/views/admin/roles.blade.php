@extends('layouts.master')
@section('title', 'Administration - Roles')
@section('content')
    <section class="main-article admin-page">
        <h1>Administration - Roles</h1>

        <div id="edit-account-menu">
            <ul>
                <li><a href="{{ action('AdminController@index') }}" class="btn btn-default">Users</a></li>
                <li><a href="{{ action('AdminController@roles') }}" class="btn btn-default">Roles</a></li>
                <li><a href="{{ action('AdminController@categories') }}" class="btn btn-default">Categories</a></li>
                <li class="add-new-category-btn">
                    <a href="{{ action('AdminController@addRole') }}" class="btn btn-default">Add New Role</a>
                </li>
            </ul>
        </div>

        <table>
            <tr>
                <th>Role</th>
                <th>Manage</th>
            </tr>
            @foreach($roles as $role)
                <tr class="users-data">
                    <td> {{ $role->name }} </td>

                    <td>
                        <a href="{{ action('AdminController@editRole', ['roleid' => $role->id]) }}">
                            Edit
                        </a>

                        <span> | </span>

                        <a href="{{ action('AdminController@removeRole', ['roleid' => $role->id]) }}" class="remove-link">
                            Remove Role
                        </a>
                    </td>
                </tr>
                <tr class="spacer"></tr>
            @endforeach
        </table>

    </section>
@endsection