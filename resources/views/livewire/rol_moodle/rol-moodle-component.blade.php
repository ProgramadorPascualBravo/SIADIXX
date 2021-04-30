    <div>
        @include("sessions.session-input")
        <div class="grid grid-cols-4 gap-2">
            <div class="col-span-4 text-right pr-4">
                <button class="btn bg-gray-800 text-white" wire:click="cancel" >Agregar nuevo registro</button>
            </div>
            <div class="col-span-3 pl-4">
                <livewire:rol-moodle-table />
            </div>
            <div class="col-span-1">
                @include("livewire.rol_moodle.$view")
            </div>
        </div>
    </div>
