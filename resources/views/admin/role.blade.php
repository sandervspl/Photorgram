<?php $role = App\Role::findOrFail($role_id)->name; ?>
@extends('layouts.master')
@section('title', $role.'s')
@section('content')
    <section class="main-article admin-page">
        <h1>Administration - {{ $role.'s' }}</h1>

        <div id="edit-account-menu">
            <ul>
                <li><a href="{{ action('AdminController@index') }}" class="btn btn-default">Users</a></li>
                <li><a href="{{ action('AdminController@roles') }}" class="btn btn-default">Roles</a></li>
                <li><a href="{{ action('AdminController@categories') }}" class="btn btn-default">Categories</a></li>
                <li class="role-filter-list-item">
                    <div class="filter-role-container">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Filter Role
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="{{ action('AdminController@index') }}">All</a></li>
                                <li class="divider"></li>
                                <?php $roles = App\Role::all() ?>
                                @foreach($roles as $role)
                                    <li>
                                        <a href="{{ action('AdminController@roles', ['role_id' => $role->id]) }}">{{ ucfirst(trans($role->name)) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <table>
            <tr>
                <th>User</th>
                <th>Role</th>
                <th>Manage</th>
            </tr>
            @if($users->count() > 0)
            @foreach($users as $user)
                <tr class="users-data">
                    <td> {{ $user->name }} </td>

                    <td>
                        {!! Form::open([
                                'action' => 'UserController@updateRole'
                            ])
                        !!}

                        {!! Form::label('', '', ['class' => 'control-label']) !!}
                        {!! Form::select(
                                'role',
                                [
                                    '1' => 'User',
                                    '2' => 'Developer',
                                    '3' => 'Moderator',
                                    '4' => 'Administrator'
                                ],
                                $user->role,
                                [
                                    'class'       => 'form control input-sm admin-role-dropdown',
                                    'required'    => 'required',
                                    'onchange'    => 'this.form.submit()'
                                ]
                            )
                        !!}

                        {!! Form::hidden('user_id', $user->id) !!}

                        {!! Form::close() !!}
                    </td>

                    <td>
                        <a href="{{ action('ProfileController@show', ['username' => $user->name]) }}">Profile</a>
                        <span> | </span>
                        Edit
                        <span> | </span>
                        Remove User
                    </td>
                </tr>
                <tr class="spacer"></tr>
            @endforeach
            @else
                <tr class="users-data">
                    <td>No users found.</td>
                </tr>
            @endif
        </table>
    </section>
@endsection