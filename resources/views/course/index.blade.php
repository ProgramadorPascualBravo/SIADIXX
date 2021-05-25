@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('course') }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Módulo de asignaturas</h1>
        </div>
        <div>
            @livewire('course-component')
        </div>
    </div>
@endsection
