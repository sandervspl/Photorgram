<?php
?>

<header>
    <div class="navbar">
        <ul class="navbar-right">
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                <li>
                    <a href="#">
                        {{ Auth::user()->name }}
                    </a>

                    {{--<ul>--}}
                        {{--<li>--}}
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        {{--</li>--}}
                    {{--</ul>--}}
                </li>
            @endif
        </ul>
    </div>
</header>
