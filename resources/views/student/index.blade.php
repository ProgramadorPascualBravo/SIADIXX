@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('students') }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center capitalize">{{ __('modules.moodle.title') }}</h1>
        </div>
        <div>
            @livewire('student-component')
        </div>
    </div>
@endsection
