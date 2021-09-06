<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <noscript>
        This page needs JavaScript activated to work.
        <style>div { display:none; }</style>
    </noscript>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('layouts.includes.head')

</head>
<body>
<div class=preloader>
    <div class=loader>
        <div class=shadow></div>
        <div class=box></div>
    </div>
</div>
    <div id="app">
        @if (Auth::user())
            {{-- @include('layouts.includes.header') --}}
        @endif
        @if (Auth::user())
            <main class="py-4" style="
                width: 100%;
                height: 100%;
                /* z-index: 99999;
                background: -webkit-gradient(linear,left top,right top,from(#ee0979),to(#ff6a00));
                background: linear-gradient(90deg,#ee0979 0,#ff6a00 100%); */
                top: 100px;
                /* position: relative; */
                left: 0;
                float: left;
                /* margin-top: 51px;*/">
        @else
            <main class="py-4">
        @endif
                @yield('content')

        </main>

        @if (Auth::user())
            @include('layouts.includes.footer')
        @endif
    </div>

</body>
</html>
