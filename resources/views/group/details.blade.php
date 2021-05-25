@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('group-detail', $group) }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">Detalle del grupo</h1>
        </div>
        <div>
            @livewire('group-detail-component', ['group' => $group] );
        </div>
    </div>
@endsection
