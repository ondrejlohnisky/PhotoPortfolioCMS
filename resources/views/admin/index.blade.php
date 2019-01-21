<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Admin - '.config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        window.__VUE_DEVTOOLS_HOST__ = 'localhost' // default: localhost
        window.__VUE_DEVTOOLS_PORT__ = '8098' // default: 8098
    </script>
    <script src="http://localhost:8098"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <admin userdata="{{ $user }}"></admin>
    </div>
</body>
</html>