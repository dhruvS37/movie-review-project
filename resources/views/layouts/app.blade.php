<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- google icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- select2 cdn -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('js/jquery.ba-bbq.js') }}"></script>
    <script src="{{ asset('js/bbq.min.js') }}"></script>
    <style>
        @keyframes fadeIn {
            0% {
                opacity: 1;
                display: none;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-2">
            <div class="container-fluid">
                <a class="navbar-brand mx-3" href="{{ env('APP_URL') }}">Movie Review</a>

                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse d-flex flex-row justify-content-evenly" id="navbarScroll">
                    <ul class="navbar-nav  my-2 my-lg-0 navbar-nav-scroll w-75" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link {{ Auth::check() && Request::is('home')? 'active' : ''}}" aria-current="page" href="/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Auth::check() && Request::is('filters') ? 'active' : ''}}" aria-current="page" href="/filters">Filter</a>
                        </li>

                        <ul class="navbar-nav mx-5" style="--bs-scroll-height: 100px;">
                            @if (Auth::guest())
                                <li class="nav-item"><a class="nav-link {{ Request::is('login') ? 'active' : ''}}" href="{{ route('login') }}">Login</a></li>
                                <li class="nav-item"><a class="nav-link {{ Request::is('register') ? 'active' : ''}}" href="{{ route('register') }}">Register</a></li>
                            @else
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }} 
                                    </a>
                                    <ul class="dropdown-menu end-0">
                                        <li>
                                            <a class="dropdown-item " href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
    
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
