<div>
    <div wire:ignore.self>
        <div class="content">
            <h5 class="subheader">Editar grupo</h5>
            @include('livewire.group.inputs')
            <div class="text-right">
                <a class="clear button close-form" wire:click="cancel">Cancelar</a>
                <a class="button" wire:click="update">Actualizar</a>
            </div>
        </div>
    </div>
</div>
