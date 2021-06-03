@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('enrollment-report') }}
    <div class="grid grid-cols-5 gap-4 ">
        <div class="col-span-5 mb-3">
            <h1 class="font-bold text-4xl my-4 text-center">{{ __('modules.stats') }}</h1>
        </div>
        <div class="col-span-3 pl-2">
            <h2 class="text-center text-3xl my-4">{{ Str::ucfirst(__('modules.enrollment.pname')) }} por mes del año {{ now()->year }}</h2>
            {!! $chartstate->container() !!}
        </div>
        <div class="col-span-2  pr-2">
            {!! $charttotal->container() !!}
        </div>
    </div>
@endsection
@push('custom-script');
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
{!! $chartstate->script() !!}
{!! $charttotal->script() !!}
@endpush