@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('students') }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center capitalize">{{ __('modules.state-enrollment.title') }}</h1>
        </div>
        <div>
            @livewire('state-enrollment-component')
        </div>
    </div>
@endsection