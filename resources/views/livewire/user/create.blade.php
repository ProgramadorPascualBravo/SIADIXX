<div>
    <div wire:ignore.self >
        <div class="content">
            <h3 class="subheader">Nuevo usuario</h3>
            @include('livewire.user.inputs')
            <div class="text-right">
                <a class="clear button close-form" wire:click="cancel">Cancelar</a>
                <a class="button" wire:click="store">Guardar</a>
            </div>
        </div>
    </div>
</div>
