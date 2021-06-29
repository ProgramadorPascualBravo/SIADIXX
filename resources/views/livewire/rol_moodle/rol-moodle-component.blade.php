    <div>
        @include("sessions.session-input")
        <div class="grid grid-cols-4 gap-2">
            @can('role_moodle_write')
                <div class="col-span-4 text-right pr-4">
                    <button class="btn bg-gray-800 text-white" wire:click="cancel" >Agregar nuevo registro</button>
                </div>
            @endcan
            <div class="@cannot('role_moodle_write') col-span-4 px-4 @endcan col-span-3 pl-4">
                <livewire:rol-moodle-table />
            </div>
            @can('role_moodle_write')
                <div class="col-span-1 content-form">
                    @include("livewire.rol_moodle.$view")
                </div>
            @endcan
        </div>
    </div>
