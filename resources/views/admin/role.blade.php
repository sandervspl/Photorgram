<?php
    $role = App\Role::findOrFail($role_id)->name;
    $p = Config::get('constants.permissions')
?>
@extends('layouts.master')
@section('title', $role.'s')
@section('content')
<section class="main-article admin-page">
    <h1>Administration - filter: {{ $role.'s' }}</h1>

    <div id="edit-account-menu">
        <ul>
            @include('partials/admin_menu')

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
                                    <a href="{{ action('AdminController@userRoles', ['role_id' => $role->id]) }}">{{ ucfirst(trans($role->name)) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    @include('partials/admin_search_users')

    <table>
        <tr>
            <th>User</th>
            <th>Banned</th>
            <th>Role</th>
            <th>Manage</th>
        </tr>
        @if($users->count() > 0)
        @foreach($users as $user)
            <tr class="users-data">
                <td> {{ $user->name }} </td>

                <?php $checked = ($user->banned) ? $checked = 'checked' : ''; ?>
                <td>
                    <input type="checkbox" name="banned" class="ban-checkbox"
                           data-userid="{{ $user->id }}" {{ $checked }}>
                </td>

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
                    <a href="{{ action('ProfileController@show', ['user_name' => $user->name]) }}">
                        Profile
                    </a>

                    <span> | </span>

                    @if (Auth::User()->role >= $p['edit_profile'])
                    <a href="{{ action('ProfileController@editProfile', ['user_name' => $user->name]) }}">
                        Edit
                    </a>
                    @else
                        Edit
                    @endif

                    <span> | </span>

                    @if (Auth::User()->role >= $p['remove_user'])
                    <a href="{{ action('AdminController@removeUser', ['user_id' => $user->id]) }}" class="remove-link">
                        Remove user
                    </a>
                    @else
                        Remove user
                    @endif
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

    <div class="text-center">
        {{ $users->links() }}
    </div>

    <div class="popup success">
        <h1>Done</h1>
    </div>

    <div class="popup fail">
        <h1>Failed</h1>
    </div>
</section>
<script>
    var banUrl = '{{ route('banUser') }}',
        token = '{{ csrf_token() }}';
</script>
@endsection