@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('enrollment') }}
    <div class="grid grid-cols-1 gap-2 px-4">
        <div>
            <h1 class="font-medium text-4xl mt-4 mb-1 text-siadi-blue-900">{{ __('modules.state-enrollment.title') }}</h1>
            <hr class="border-siadi-blue-700">
        </div>
        <div>
            @livewire('enrollment-component')
        </div>
    </div>
@endsection
