<?php $p = Config::get('constants.permissions') ?>
@extends('layouts.master')
@section('title', 'Administration - Roles')
@section('content')
    <section class="main-article admin-page">
        <h1>Administration - Roles</h1>

        <div id="edit-account-menu">
            <ul>
                @include('partials/admin_menu')

                @if (Auth::User()->role >= $p['add_role'])
                <li class="add-new-category-btn">
                    <a href="{{ action('AdminController@addRole') }}" class="btn btn-default">Add New Role</a>
                </li>
                @endif
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
                        @if (Auth::User()->role >= $p['edit_role'])
                        <a href="{{ action('AdminController@editRole', ['roleid' => $role->id]) }}">
                            Edit
                        </a>
                        @else
                            Edit
                        @endif

                        <span> | </span>

                        @if($role->id != 1 && (Auth::User()->role >= $p['remove_role']))
                        <a href="{{ action('AdminController@removeRole', ['roleid' => $role->id]) }}" class="remove-link">
                            Remove Role
                        </a>
                        @else
                            Remove Role
                        @endif
                    </td>
                </tr>
                <tr class="spacer"></tr>
            @endforeach
        </table>

    </section>
@endsection