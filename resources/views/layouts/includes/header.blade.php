<div class="navbar-area">
    <div class="luvion-responsive-nav">
        <div class="container">
            <div class="luvion-responsive-menu">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                        <img src="{{asset('assets/img/logo.png')}}" alt="logo">
                        <img src="{{asset('assets/img/black-logo.png')}}" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="luvion-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('assets/img/logo.png')}}" alt=logo>
                    <img src="{{asset('assets/img/black-logo.png')}}" alt="logo">
                </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    @include('layouts.includes.menu')
                </div>
            </nav>
        </div>
    </div>
</div>
