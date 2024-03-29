<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico"/>

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name') }}</title>

   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>

   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v3.3"></script>
    <div id="app">
         <page></page>
    </div>
</body>
</html>