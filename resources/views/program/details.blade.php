@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('program-detail', $program) }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Detalle del programa</h1>
        </div>
        <div>
            @livewire('program-detail-component', ['program' => $program] );
        </div>
    </div>
@endsection
