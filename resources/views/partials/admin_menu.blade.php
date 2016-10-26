<li><a href="{{ action('AdminController@index') }}" class="btn btn-default">Users</a></li>
@if (Auth::User()->role >= $p['edit_role'])
<li><a href="{{ action('AdminController@roles') }}" class="btn btn-default">Roles</a></li>
@endif
<li><a href="{{ action('AdminController@categories') }}" class="btn btn-default">Categories</a></li>