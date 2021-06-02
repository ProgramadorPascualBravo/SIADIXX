@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('student-mass-creation') }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">{{ __('modules.moodle.massive') }}</h1>
        </div>
        <div>
            @livewire('student-mass-creation-component')
        </div>
    </div>
@endsection
