@extends('layouts.app')
@section('content')
    <div class="medium-12 cell">
        <h2 class="h1">Módulo cursos</h2>
    </div>
    <div class="medium-12 cell">
        @livewire('course-component')
    </div>
@endsection
