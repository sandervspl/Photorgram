<html lang="en">
<head>
    @include('partials/head')
    <title>Photogram - @yield('title')</title>
</head>
<body>
    @if ( ! Auth::Guest() && App\User::findOrFail(Auth::id())->role == 4)
        @include('partials/header_admin')
    @else
        @include('partials/header')
    @endif

    <div class="container">
        @yield('content')
    </div>

    @include('partials/footer')
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>
</body>
</html>