@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('category') }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Módulo de categorías</h1>
        </div>
        <div>
            @livewire('department-component')
        </div>
    </div>
@endsection
