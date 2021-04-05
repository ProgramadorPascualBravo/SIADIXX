<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/foundation-icons/foundation-icons.css') }}">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
                <li>
                    <a href="{{ route('dashboard') }}">SIADI</a>
                </li>
                <li>
                    <a href="#">Módulos</a>
                    <ul class="menu vertical">
                        <li><a href="{{ route('user-index') }}">Usuarios</a></li>
                        <li><a href="{{ route('student-index') }}">Usuarios Moodle</a></li>
                        <li><a href="{{ route('department-index') }}">Departamentos</a></li>
                        <li><a href="{{ route('program-index') }}">Programas</a></li>
                        <li><a href="{{ route('course-index') }}">Cursos</a></li>
                        <li><a href="{{ route('group-index') }}">Grupos</a></li>
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
                    <a href="#">{{ Auth::user()->name }} {{ Auth::user()->last_name }} <i class="fi-torso"></i></a>
                    <ul class="menu vertical">
                        <li><a href="#">Departamento: {{ Auth::user()->department->name }}</a></li>
                        <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="grid-x" style="padding: 1em">
        @include('sessions.session')
        @yield('content')
    </div>
    <script src="{{ asset('js/alpine.min.js')  }}" defer></script>
    @livewireScripts
    <script src="{{ asset('js/app.js')  }}"></script>
</body>
</html>
