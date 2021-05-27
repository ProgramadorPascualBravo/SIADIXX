<div class="m-4">
    <a href="#" class="rounded-full hover:bg-blue-200 h-32 w-32 bg-white text-blue-700 border-4 border-blue-700 font-bold inline-flex justify-center text-center p-5 flex-col">
        <h3 class="text-3xl">
            {{ $eloquent::query()->count() }}
        </h3>
        <p class="text-sm">
            {{ $title }}
        </p>
        <p>
            {{ $months[now()->format('m')] }}
        </p>
    </a>
</div>