    <div>
        @include("sessions.session-input")
        <div class="grid grid-cols-4 gap-2">
            @can('category_write')
                <div class="col-span-4 text-right pr-4">
                    <button class="btn bg-gray-800 text-white" wire:click="cancel" >Agregar nuevo registro</button>
                </div>
            @endcan
            <div class="@cannot('category_write') col-span-4 px-4 @endcan col-span-3 pl-4">
                <livewire:department-table />
            </div>
            @can('category_write')
                <div class="col-span-1 content-form">
                    @include("livewire.department.$view")
                </div>
            @endcan
        </div>
    </div>

