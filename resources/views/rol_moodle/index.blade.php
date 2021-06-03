@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('role_moodle') }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">{{ __('modules.role-moodle.title') }}</h1>
        </div>
        <div>
            @livewire('rol-moodle-component')
        </div>
    </div>
@endsection

