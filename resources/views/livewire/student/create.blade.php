<div class="px-5">
    <div wire:ignore.self >
        <div class="my-4">
            <h2 class="text-2xl mb-4 text-center">Nuevo usuario</h2>
            @include('livewire.student.inputs')
            <div class="text-right my-4 flex flex-row-reverse">
                <button class="btn btn-green mr-0" wire:click="store">
                    <span>Guardar</span>
                </button>
                <button class="btn btn-red" wire:click="cancel">
                    <span>Cancelar</span>
                </button>
            </div>
        </div>
    </div>
</div>
