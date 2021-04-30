<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/foundation-icons/foundation-icons.css') }}">
    <!--<link href="{{ asset('css/app.scss') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @livewireStyles
</head>
<body>
<header>
    <nav class="flex items-center bg-gray-800 p-4 text-white">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <span class="font-semibold text-xl tracking-tight">SIADI</span>
        </div>
        <div class="mr-6 relative" x-data="{ open : false}" >
            <a @click="open = true" class="cursor-pointer">Módulos</a>
            <ul x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90" @click.away="open = false" class="absolute bg-gray-800 rounded w-40 z-30">
                <li><a class="block my-4 w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-800" href="{{ route('user-index') }}">Usuarios</a></li>
                <li><a class="block my-4 w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-800" href="{{ route('student-index') }}">Usuarios Moodle</a></li>
                <li><a class="block my-4 w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-800" href="{{ route('department-index') }}">Categorías</a></li>
                <li><a class="block my-4 w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-800" href="{{ route('program-index') }}">Programas</a></li>
                <li><a class="block my-4 w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-800" href="{{ route('course-index') }}">Asignaturas</a></li>
                <li><a class="block my-4 w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-800" href="{{ route('group-index') }}">Grupos</a></li>
                <li><a class="block my-4 w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-800" href="{{ route('rol-moodle-index') }}">Roles Matrícula</a></li>
                <li><a class="block my-4 w-full px-4 py-2 hover:bg-gray-100 hover:text-gray-800" href="{{ route('enrollment-index') }}">Matrículas</a></li>
            </ul>
        </div>
        <div>
            <a href="">Búsquedas</a>
        </div>
        <div class="flex-1 text-right relative" x-data="{ open : false }">
            <a @click="open = true" class="text-white cursor-pointer bg-gray-300 py-2 px-4 rounded text-gray-800">{{ Auth::user()->name }} {{ Auth::user()->last_name }} <i class="fi-torso"></i></a>
            <ul  x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-90"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-90" @click.away="open = false" class="absolute rounded w-60 z-30 right-0 bg-gray-100 mt-2">
                <li><a class="block text-gray-800 hover:bg-gray-700 hover:text-white py-2 px-4" href="#"><b><u>Categoria</u>:</b> {{ Auth::user()->department->name }}</a></li>
                <li><a class="block text-gray-800 hover:bg-gray-700 hover:text-white py-2 px-4" href="{{ route('logout') }}">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>
</header>
    @yield('content')
    <script src="{{ asset('js/alpine.min.js')  }}" defer></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
    @livewireScripts
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
