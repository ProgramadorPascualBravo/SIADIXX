<div>
    <div wire:ignore.self>
        <div class="content">
            <h5 class="subheader">Editar programa</h5>
            @include('livewire.program.inputs')
            <div class="text-right">
                <a class="clear button close-form" wire:click="cancel">Cancelar</a>
                <a class="button" wire:click="update">Actualizar</a>
            </div>
        </div>
    </div>
</div>
