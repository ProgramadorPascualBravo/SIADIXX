@extends('layouts.app')
@section('content')
    <div class="medium-12 cell">
        <h2 class="h1">Módulo de departamentos</h2>
    </div>
    <div class="medium-12 cell">
        @livewire('department-component')
    </div>
@endsection
