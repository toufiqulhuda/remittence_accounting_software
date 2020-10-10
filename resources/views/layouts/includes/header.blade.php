<div class="navbar-area">
    <div class="luvion-responsive-nav">
        <div class="container">
            <div class="luvion-responsive-menu">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                        <img src="assets/img/logo.png" alt="logo">
                        <img src="assets/img/black-logo.png" alt="logo">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="luvion-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ url('/') }}"> <img src="assets/img/logo.png" alt=logo> <img src="assets/img/black-logo.png" alt="logo"> </a>
                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link active">Home</a>

                        </li>
                        <li class="nav-item"><a href="index.html" class="nav-link">Why choose us</a>

                        </li>
                        <li class="nav-item"><a href="index.html#benefits" class="nav-link">Key benefits </a>

                        </li>

                        <li class="nav-item"><a href="index.html#services" class="nav-link">What we do</a></li>

                        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>