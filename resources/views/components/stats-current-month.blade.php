<div class="m-4">
    <a href="{{ route($route) }}" class="hover:bg-blue-200 h-28 w-48 bg-white text-blue-700 border-2 border-blue-700 inline-flex justify-center text-center p-5 flex-col">
        <h3 class="text-3xl">
            {{ $eloquent::month()->get()->count() }}
        </h3>
        <p class="text-sm">
            {{ $title }}
        </p>
        <p>
            {{  \App\View\Components\StatsCurrentMonthComponent::getMonth(now()->format('m')) }}
        </p>
    </a>
</div>