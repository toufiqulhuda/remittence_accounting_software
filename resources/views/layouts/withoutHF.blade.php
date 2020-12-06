<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


</head>
<body>
<div class=preloader>
    <div class=loader>
        <div class=shadow></div>
        <div class=box></div>
    </div>
</div>
    <div id="app">

        <main class="py-4" style="
            width: 100%;
            height: 100%;
            /* z-index: 99999;
            background: -webkit-gradient(linear,left top,right top,from(#ee0979),to(#ff6a00));
            background: linear-gradient(90deg,#ee0979 0,#ff6a00 100%); */
            top: 100px;
            position: relative;
            left: 0;">
            @yield('content')

        </main>


    </div>

</body>
</html>
