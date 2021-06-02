<div class="px-5">
    <div wire:ignore.self >
        <div class="my-4">
            <h2 class="text-2xl mb-4 text-center capitalize">{{ __('modules.user.create') }}</h2>
            @include('livewire.user.inputs')
            @include('fragments.btn-create')
        </div>
    </div>
</div>
