<header class="admin" id="nav-header">
<nav id="navigation">
    <div class="left col-md-3">
        <a href="/">
            <img src="{{ url('img/logo_full.png') }}" alt="logo" id="logo">
        </a>
    </div>

    <div class="right menu-icon col-md-9">
        <div class="search">
            <button class="search-btn"></button>
        </div>
        <div class="icon">☰</div>
    </div>
    <div class="right menu col-md-9">
        <ul>
            <li>
                <a href=" {{ action('ImageController@upload') }}">
                    Upload Image
                </a>
            </li>
            <li>
                <a href="{{ action('ImageController@allImages') }}">
                    Categories
                </a>
            </li>

            <li>
                <div class="dropdown" id="nav-user-dropdown">
                    <button class="btn btn-default dropdown-toggle user-dropdown" type="button" id="dropdownMenu1"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ Auth::user()->name }}
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li>
                            <a href="{{ action('AdminController@index') }}">
                                Admin Page
                            </a>
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
                <button class="search-btn"></button>
            </li>
        </ul>
    </div>
</nav>
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