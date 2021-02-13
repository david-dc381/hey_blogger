<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{-- {{ config('app.name', 'Laravel') }} --}}
        Hey Blogger :)
    </title>

    <!-- Scripts -->    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel= "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css"/>




</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm fixed-top" style="background: linear-gradient(232.5deg, #11E9A4 0%, #3FC89D 25%, #26C9CF 50%, #1584D3 75%, #1554D3 100%);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    Hey Blogger :)
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        {{-- mostramos las opciones para el que este logueado --}}
                        @if ( Route::has('login') )
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/') }}" class="nav-link text-white">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('posts') }}" class="nav-link text-white">Posts</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('etiquetas') }}" class="nav-link text-white">Etiquetas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('categorias') }}" class="nav-link text-white">Categorias</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('roles') }}" class="nav-link text-white">Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('usuarios') }}" class="nav-link text-white">Usuarios</a>
                                </li>
                            @endauth
                        @endif

                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <!-- <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a> -->
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombre_usuario }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">Pérfil</a>
                                                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>
</body>
<!-- importamos este código a todos las vistas -->
@yield('summernote')
</html>
