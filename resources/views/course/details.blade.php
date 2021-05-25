@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('course-detail', $course) }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Detalle de la asignatura</h1>
        </div>
        <div>
            @livewire('course-detail-component', ['course' => $course] );
        </div>
    </div>
@endsection
