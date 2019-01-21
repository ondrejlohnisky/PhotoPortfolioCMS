<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/brands.js" integrity="sha384-S2C955KPLo8/zc2J7kJTG38hvFV+SnzXM6hwfEUhGHw5wPo6uXbnbjSJgw3clO4G" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/fontawesome.js" integrity="sha384-bNOdVeWbABef8Lh4uZ8c3lJXVlHdf8W5hh1OpJ4dGyqIEhMmcnJrosjQ36Kniaqm" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            position:absolute;
            height:100%;
            width:100%;
            overflow: auto;
            background-image: url('/images/Decin_mlha_2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
