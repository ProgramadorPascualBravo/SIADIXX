<div>
    <div wire:ignore.self  id="form-edit" class="show-form" data-type="edit">
        <div class="content">
            <h3 class="subheader">Editar usuario</h3>
            @include('livewire.user.inputs')
            <div class="text-right">
                <a class="clear button close-form" wire:click.prevent="cancel">Cancelar</a>
                <a class="button" wire:click="update">Actualizar</a>
            </div>
        </div>
    </div>
</div>
