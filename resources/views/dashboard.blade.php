@extends('layouts.app')
@section('content')
    {{ Breadcrumbs::render('dashboard') }}
    <div class="grid grid-cols-5 gap-4 px-4">
        <div class="col-span-5 @cannot('report_read') hidden @endcan">
            <h2 class="text-left font-bold text-3xl mt-4 mb-1 text-siadi-blue-900">Estadisticas del mes de {{ \App\View\Components\StatsCurrentMonthComponent::getMonth([date('m')]) }}</h2>
            <hr class="border-siadi-blue-700">
            <div class="flex flex-wrap">
                @foreach(['moodle', 'course', 'enrollment'] as $group)
                    <x-stats-current-month-component :type="$group"/>
                @endforeach
            </div>
        </div>
        <div class="col-span-5">
            <h2 class="font-bold text-3xl mt-4 mb-1 text-siadi-blue-900">Módulos</h2>
            <hr class="border-siadi-blue-700">
            <div class="flex flex-wrap">
                @foreach(Auth::user()->getAllPermissions()->filter(function ($item) {
                      return false !== stripos($item, 'read');
                   }) as $permission)
                    @if($permission->name == 'report_read' or $permission->name == 'logs_read')
                        @continue;
                    @endif
                    <x-access-module-component :permission="$permission->name" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
