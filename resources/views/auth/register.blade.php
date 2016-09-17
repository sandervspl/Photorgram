@extends('layouts.master')
@section('title', 'Register')
@section('content')
<section class="main-article">
    <h1>Register</h1>
    <form role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}

        <div>
            <label for="name">Name</label>
            <div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div>
            <label for="email">E-Mail Address</label>
            <div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div>
            <label for="password">Password</label>
            <div>
                <input id="password" type="password" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div>
            <label for="password-confirm">Confirm Password</label>
            <div>
                <input id="password-confirm" type="password" name="password_confirmation" required>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</section>
@endsection
