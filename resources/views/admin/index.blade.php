@extends('layouts.master')
@section('title', 'All Users')
@section('content')
<section class="main-article admin-page">
    <h1>Administration - All Users</h1>

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
                                    <a href="{{ action('AdminController@userRoles', ['role_id' => $role->id]) }}">{{ ucfirst(trans($role->name)) }}</a>
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
        @foreach($users as $user)
        <tr class="users-data">
            <td> {{ $user->name }} </td>

            <td>
                {!! Form::open([
                        'action' => 'UserController@updateRole'
                    ])
                !!}

                <label for="role" class="control-label"></label>
                <select name="role" id="{{ $user->id }}-role" class="form control input-sm admin-role-dropdown role-list"
                        data-userid="{{ $user->id }}" data-userrole="{{ $user->role }}">
                    @foreach(\App\Role::all() as $role)
                        @if($user->role == $role->id)
                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                </select>

                {!! Form::hidden('user_id', $user->id) !!}

                {!! Form::close() !!}
            </td>

            <td>
                <a href="{{ action('ProfileController@show', ['user_name' => $user->name]) }}">
                    Profile
                </a>

                <span> | </span>

                <a href="{{ action('ProfileController@editProfile', ['user_name' => $user->name]) }}">
                    Edit
                </a>

                <span> | </span>

                <a href="{{ action('AdminController@removeUser', ['user_name' => $user->name]) }}" class="remove-link">
                    Remove user
                </a>
            </td>
        </tr>
        <tr class="spacer"></tr>
        @endforeach
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
    var updateRoleUrl = '{{ route('updateRole') }}',
        token = '{{ csrf_token() }}';
</script>
@endsection