@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Módulo de grupos</h1>
        </div>
        <div>
            @livewire('group-component')
        </div>
    </div>
@endsection
