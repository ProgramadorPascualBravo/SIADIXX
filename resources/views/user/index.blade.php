@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('users') }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">{{ __('modules.user.title') }}</h1>
        </div>
        <div>
            @livewire('user-component')
        </div>
    </div>
@endsection
