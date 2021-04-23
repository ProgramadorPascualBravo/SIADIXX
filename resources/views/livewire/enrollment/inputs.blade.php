<div class="medium-12 cell">
    <div class="medium-12 cell">
        <label for="code">Código - Grupo
            <select class="@error('code') is-invalid-input @enderror" name="code" id="code" wire:model.defer="code">
                <option value="">Seleccione una opción</option>
                @foreach($groups as $group)
                    <option value="{{ $group->code }}">{{ $group->code }} - {{ $group->name }}</option>
                @endforeach
            </select>
            @error('code')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>

    <label for="email">Correo institucional<input class="@error('email') is-invalid-input @enderror" type="email" name="email" id="email" wire:model.defer="email"></label>
    @error('email')
    <span class="form-error is-visible">{{ $message }}</span>
    @enderror

    <div class="medium-12 cell">
        <label for="rol">Rol
            <select class="@error('rol') is-invalid-input @enderror" name="rol" id="rol" wire:model.defer="rol">
                <option value="">Seleccione una opción</option>
                @foreach($roles as $rol)
                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                @endforeach
            </select>
            @error('rol')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>

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
