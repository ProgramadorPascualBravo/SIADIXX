<div class="px-5">
    <div wire:ignore.self >
        <div class="my-4">
            <h3 class="text-2xl mb-4 text-center">Editar matrícula</h3>
            @include('livewire.enrollment.inputs')
            <div class="text-right my-4 flex flex-row-reverse">
                <button class="btn btn-blue mr-0" wire:click="update">
                    <span>Actualizar</span>
                </button>
                <button class="btn btn-red" wire:click="cancel">
                    <span>Cancelar</span>
                </button>
            </div>
        </div>
    </div>
</div>
