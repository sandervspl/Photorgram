<div id="edit-account-menu">
    <ul>
        <li><a href="{{ action('ProfileController@editAccount', ['user_name' => $user->name]) }}" class="btn btn-default">Account</a></li>
        <li><a href="{{ action('ProfileController@editProfile', ['user_name' => $user->name]) }}" class="btn btn-default">Profile</a></li>
    </ul>
</div>