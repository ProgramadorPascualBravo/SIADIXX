<div>
    @include("sessions.session-input")
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-4 text-right pr-4">
            @can('user_write')
                <button class="btn bg-gray-800 text-white" wire:click="cancel" >Agregar nuevo registro</button>
            @endcan
        </div>
        <div class="@cannot('user_write') col-span-4 px-4 @endcan col-span-3 pl-4">
            <livewire:user-table />
        </div>
        @can('user_write')
            <div class="col-span-1">
                @include("livewire.user.$view")
            </div>
        @endcan
    </div>
</div>
