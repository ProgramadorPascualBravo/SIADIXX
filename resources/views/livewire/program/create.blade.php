<div>
    <div wire:ignore.self>
        <div class="content">
            <h5 class="subheader">Nuevo programa</h5>
            @include('livewire.program.inputs')
            <div class="text-right">
                <a class="clear button close-form" wire:click="cancel">Cancelar</a>
                <a class="button" wire:click="store">Guardar</a>
            </div>
        </div>
    </div>
</div>
