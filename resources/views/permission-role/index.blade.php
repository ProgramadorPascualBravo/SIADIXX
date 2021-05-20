@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Módulo de Roles y Permisos</h1>
        </div>
        <div class="px-4">
            <a class="btn btn-blue {{ $option ? '' : 'bg-blue-300' }} inline-flex" href="{{ route('role-index') }}">Roles</a>
            <a href="{{ route('permission-index') }}" class="btn btn-blue {{ $option ? 'bg-blue-300' : '' }}">Permisos</a>
        </div>
        <div>
            @if($option)
                @livewire('permission-component')
            @else
                @livewire('role-component')
            @endif
        </div>
    </div>
@endsection
