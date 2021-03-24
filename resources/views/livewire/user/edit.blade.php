<div>
    <div wire:ignore.self >
        <div class="content">
            <h3 class="subheader">Editar usuario</h3>
            @include('livewire.user.inputs')
            <div class="text-right">
                <a class="clear button close-form" wire:click="cancel">Cancelar</a>
                <a class="button" wire:click="update">Actualizar</a>
            </div>
        </div>
    </div>
</div>
