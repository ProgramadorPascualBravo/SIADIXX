@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('user-detail', $user) }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Perfil de usuario</h1>
        </div>
        <div>
            @livewire('user-detail-component', ['user' => $user] );
        </div>
    </div>
@endsection
