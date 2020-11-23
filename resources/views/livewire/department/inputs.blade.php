<div class="medium-12 cell">
    <label for="name">Nombre<input class="@error('name') is-invalid-input @enderror" type="text" name="name" id="name" wire:model.defer="name"></label>
    @error('name')
        <span class="form-error is-visible">{{ $message }}</span>
    @enderror

    <div class="medium-12 cell">
        <label for="state">Estado
            <select class="@error('state') is-invalid-input @enderror" name="state" id="state" wire:model.defer="state">
                <option value="">Seleccione una opción</option>
                <option value="1">Activo</option>
                <option value="0">Desactivado</option>
            </select>
            @error('state')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
</div>
