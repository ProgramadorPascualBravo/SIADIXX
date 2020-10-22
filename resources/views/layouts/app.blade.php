<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li>
                    <a href="{{ route('dashboard') }}">Suanfonson</a>
                </li>
                <li>
                    <a href="#">Módulos</a>
                    <ul class="menu vertical">
                        <li><a href="{{ route('user-index') }}">Usuarios</a></li>
                        <li><a href="{{ route('department-index') }}">Departamentos</a></li>
                        <li><a href="#">Three</a></li>
                    </ul>
                </li>
                <li><a href="#">Busqueda</a></li>
            </ul>
        </div>
        <div class="top-bar-right">
            <ul class="dropdown menu" data-dropdown-menu>
                <li>
                    <a href="#">Agregar +</a>
                    <ul class="menu vertical">
                        <li><a href="#">Usuarios</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</a>
                    <ul class="menu vertical">
                        <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="grid-x">
        @include('sessions.session')
        @yield('content')
    </div>
    @livewireScripts
    <script src="{{ asset('js/app.js')  }}"></script>
</body>
</html>