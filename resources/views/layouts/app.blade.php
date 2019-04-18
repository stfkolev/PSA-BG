<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PSA-BG') }}</title>

    <!-- Scripts -->
    {!! NoCaptcha::renderJs() !!}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'PSA-BG') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Request::path() == 'home' ? 'active' : ''}}">
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>

                        <li class="nav-item {{ Request::path() == 'shots' ? 'active' : ''}}">
                                <a class="nav-link" href="{{ url('/shots') }}">Shots</a>
                        </li>

                        <li class="nav-item {{ Request::path() == 'discussions' ? 'active' : ''}}">
                                <a class="nav-link" href="{{ url('/discussions') }}">Discussions</a>
                        </li>

                        <li class="nav-item {{ Request::path() == 'requests' ? 'active' : ''}}">
                                <a class="nav-link" href="{{ url('/requests') }}">Requests</a>
                        </li>

                        <li class="nav-item {{ Request::path() == 'users' ? 'active' : ''}}">
                                <a class="nav-link" href="{{ url('/users') }}">Users</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(isset(Auth::user()->avatar))
                                     <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="rounded" width="35px" height="35px"/> &nbsp;
                                    @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('shots.mine') }}">My shots</a>
                                    <a class="dropdown-item" href="{{ route('likes.mine') }}">My likes</a>
                                    <a class="dropdown-item" href="{{ route('discussions.mine') }}">My discussions</a>
                                    <a class="dropdown-item" href="{{ route('requests.mine') }}">My requests</a>
                                    @role('admin')
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('admin') }}">Administration</a>
                                    @endrole
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
