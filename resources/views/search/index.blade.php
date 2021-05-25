@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('search') }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Módulo de búsqueda</h1>
        </div>
        <div>
            @livewire('search-component')
        </div>
    </div>
@endsection
