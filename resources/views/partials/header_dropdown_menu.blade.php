<ul class="dropdown-menu mobile" aria-labelledby="dropdownMenu1">
    <li>
        <span>{{ Auth::User()->name }}</span>
    </li>

    <li role="separator" class="divider"></li>

    @if ( ! Auth::Guest() && Auth::User()->role >= $p['admin_controls'])
        <li>
            <a href="{{ action('AdminController@index') }}">
                Admin Page
            </a>
        </li>
    @else
        <li>
            <a href="{{ action('ProfileController@show', ['user_name' => Auth::user()->name]) }}">
                My Profile
            </a>
        </li>

        <li>
            <a href="{{ action('ProfileController@editAccount', Auth::user()->name) }}">
                Edit Account
            </a>
        </li>
    @endif

    <li role="separator" class="divider"></li>

    <li>
        <a href="{{ url('/logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>