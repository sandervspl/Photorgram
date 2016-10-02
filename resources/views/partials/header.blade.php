<header>
    <div class="navbar">
        <div class="navbar-left">
            <ul class="navbar-links">
                <li><a href="{{ url('/') }}" id="navbar-logo">Photorgram</a></li>
            </ul>
        </div>

        <div class="navbar-right">
            @if (Auth::guest())
            <ul class="signin-register-list">
                <li><a href="{{ url('/login') }}">Sign In</a></li>
                <li class="horizontal-list-divider"></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            </ul>
            @else
            <ul>
                <li><a href="{{ action('ImageController@all') }}">All Images</a></li>
                <li class="horizontal-list-divider"></li>
                <li><a href=" {{ action('ImageController@upload') }}">Upload Image</a></li>

                <li>
                <div class="dropdown" id="user-dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ Auth::user()->name }}
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li>
                            <a href="{{ action('ProfileController@show', ['user_name' => Auth::user()->name]) }}">My Profile</a>
                        </li>

                        <li>
                            <a href="{{ action('ProfileController@editAccount', ['user_name' => Auth::user()->name]) }}">Edit Account</a>
                        </li>

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
                </div>
                </li>
                <li>
                    <button id="search-btn"></button>
                </li>
            @endif
            </ul>
        </div>
    </div>
</header>
<div id="searchbar">
    {!! Form::open([
            'action' => 'SearchController@search',
            'id'     => 'searchbar-form'
        ])
    !!}

    {!! Form::label('', '') !!}
    {!! Form::text('search', '', [
        'required' => 'required',
        'id' => 'searchbar-input',
        'placeholder' => 'What are you looking for?'
    ]) !!}

    {!! Form::close() !!}
    <img src="{{ url('img/clear.png') }}" alt="clear" id="searchbar-clear">
</div>
