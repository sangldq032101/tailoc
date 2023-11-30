<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/style.css') }}">
</head>

<body class="d-flex align-items-center justify-content-center">
    <div class="h1 mb-0">
        <span>@yield('code') | @yield('message')</span>
    </div>
    <script src="{{ mix('assets/js/app.js') }}"></script>
</body>

</html>
