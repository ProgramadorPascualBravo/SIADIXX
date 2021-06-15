@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('dashboard') }}
    <div class="grid grid-cols-5 gap-4 px-2">
        <div class="col-span-5 @cannot('report_read') hidden @endcan">
            <h2 class="text-center font-bold text-3xl my-4">Estadisticas del mes de {{ \App\View\Components\StatsCurrentMonthComponent::getMonth([date('m')]) }}</h2>
            <div class="flex flex-wrap justify-center">
                @foreach(['moodle', 'course', 'enrollment'] as $group)
                    <x-stats-current-month-component :type="$group"/>
                @endforeach
            </div>
        </div>
        <div class="col-span-5">
            <h2 class="text-center font-bold text-3xl my-4">Módulos</h2>
            <div class="flex flex-wrap justify-center">
                @foreach(Auth::user()->getAllPermissions()->filter(function ($item) {
                      return false !== stripos($item, 'read');
                   }) as $permission)
                    @if($permission->name == 'report_read')
                        @continue;
                    @endif
                    <x-access-module-component :permission="$permission->name" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
