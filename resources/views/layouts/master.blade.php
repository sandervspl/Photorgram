<?php $p = Config::get('constants.permissions') ?>
<html lang="en">
<head>
    @include('partials/head')
    <title>Photogram - @yield('title')</title>
</head>
<body>
    @include('partials/header')

    <div class="se-pre-con"></div>

    <div class="container">
        @yield('content')
    </div>

    @include('partials/footer')
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>
</body>
</html>