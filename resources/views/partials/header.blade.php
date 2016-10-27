@if ( ! Auth::Guest() && Auth::User()->role >= $p['admin_controls'])
<header class="admin" id="nav-header">
@else
<header id="nav-header">
@endif
<nav id="navigation">
    <div class="left logo col-xs-3">
        <a href="/">
            <img src="{{ url('img/logo_full.png') }}" alt="Photorgram" class="logo">
        </a>
    </div>

    <div class="left menu-icon col-xs-2">
        <div class="icon">
            <button class="dropdown-toggle user-dropdown" type="button" id="dropdownMenu1"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                ☰
            </button>

            @if ( ! Auth::Guest())
                @include('partials.header_dropdown_menu')
            @else
                @include('partials.header_dropdown_menu_guest')
            @endif
        </div>
    </div>

    <div class="middle col-xs-8">
        <a href="/">
        <img src="{{ url('img/logo_full.png') }}" alt="Photorgram" class="logo">
        </a>
    </div>

    <div class="right small col-xs-2">
        <div class="search">
            <button class="search-btn"></button>
        </div>
    </div>
    @if (Auth::guest())
    <div class="right menu guest col-xs-9">
        <ul class="signin-register-list">
            <li>
                <a href="{{ action('ImageController@allImages') }}">
                    Categories
                </a>
            </li>
            <li>
                <a href="{{ url('/login') }}">Sign In</a>
            </li>
            <li>
                <a href="{{ url('/register') }}">Register</a>
            </li>
        </ul>
    </div>
    @else
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
                <button class="button button-default dropdown-toggle user-dropdown" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                </button>

                @include('partials.header_dropdown_menu')
            </div>
            </li>
            <li>
                <button class="search-btn"></button>
            </li>
        </ul>
    </div>
    @endif
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