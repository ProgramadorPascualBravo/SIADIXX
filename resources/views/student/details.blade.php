@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('students-detail', $student) }}
    <div class="grid grid-cols-1 gap-2">
        <div>
            <h1 class="font-bold text-4xl my-4 text-center">{{ __('modules.moodle.detail') }}</h1>
        </div>
        <div>
            @livewire('student-detail-component', ['student' => $student] );
        </div>
    </div>
@endsection
