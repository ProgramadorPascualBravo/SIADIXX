@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('students-report') }}
    <div class="grid grid-cols-5 gap-4">
        <div class="col-span-5 mb-3">
            <h1 class="font-bold text-4xl my-4 text-center">{{ __('modules.stats') }}</h1>
        </div>
        <div class="col-span-4 pl-2">
            <a href="{{ route('moodle-report-download') }}" target="_blank" class="btn btn-green">
                <svg class="h-5 w-5 stroke-current ml-2" fill="none" viewBox="0 0 384 512"><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm212-240h-28.8c-4.4 0-8.4 2.4-10.5 6.3-18 33.1-22.2 42.4-28.6 57.7-13.9-29.1-6.9-17.3-28.6-57.7-2.1-3.9-6.2-6.3-10.6-6.3H124c-9.3 0-15 10-10.4 18l46.3 78-46.3 78c-4.7 8 1.1 18 10.4 18h28.9c4.4 0 8.4-2.4 10.5-6.3 21.7-40 23-45 28.6-57.7 14.9 30.2 5.9 15.9 28.6 57.7 2.1 3.9 6.2 6.3 10.6 6.3H260c9.3 0 15-10 10.4-18L224 320c.7-1.1 30.3-50.5 46.3-78 4.7-8-1.1-18-10.3-18z"></path></svg>
            </a>
            {!! $chartstate->container() !!}
        </div>
        <div class="col-span-1 pr-2">
            {!! $charttotal->container() !!}
        </div>
    </div>
@endsection
@push('custom-script');
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
{!! $chartstate->script() !!}
{!! $charttotal->script() !!}
@endpush