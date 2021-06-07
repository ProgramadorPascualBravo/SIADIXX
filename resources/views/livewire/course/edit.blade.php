<div class="px-5">
    <div wire:ignore.self >
        <div class="my-4">
            <h3 class="text-2xl mb-4 text-center">{{ __('modules.course.edit') }}</h3>
            @include('livewire.course.inputs')
            @include('fragments.btn-update')
        </div>
    </div>
</div>
