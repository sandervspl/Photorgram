<?php
?>

<header>
    <div class="navbar">
        <div class="navbar-left">
            <a href="{{ url('/') }}">Photorgram</a>
        </div>

        <div class="navbar-right">
            @if (Auth::guest())
            <ul class="signin-register-list">
                <li><a href="{{ url('/login') }}">Sign In</a></li>
                <li class="horizontal-list-divider"> | </li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            </ul>
            @else
            <ul>
                <div class="upload-link">
                    <a href=" {{ action('ImageController@upload') }}">Upload Image</a>
                </div>

                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ Auth::user()->name }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="{{ url('/images') }}">My Library</a></li>
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
            @endif
            </ul>
        </div>
    </div>
</header>
