@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('enrollment-report') }}
    <div class="grid grid-cols-5 gap-4 ">
        <div class="col-span-5 mb-3">
            <h1 class="font-bold text-4xl my-4 text-center">{{ __('modules.stats') }}</h1>
        </div>
        <div class="col-span-1 pl-2">
            <div>
                <table class="mb-3 w-full">
                    <thead>
                        <tr class="border-2 bg-blue-300 border-gray-900">
                            <th class="text-left p-3">Estado</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($states as $state => $value)
                        <tr class="border-2 hover:bg-blue-100 border-gray-900">
                            <td class="px-4 py-2">{{ $state }}</td>
                            <td class="px-4 py-2 text-center font-bold">{{ $value }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {!! $charttotal->container() !!}
            </div>
        </div>
        <div class="col-span-4 pr-2 col-row-2">
            {!! $chartstate->container() !!}
        </div>

    </div>
@endsection
@push('custom-script');
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
{!! $chartstate->script() !!}
{!! $charttotal->script() !!}
@endpush