<div class="grid grid-cols-1 gap-2">
    <label class="block">
        <span class="text-gray-700">Código - Grupo</span>
        <select class="@error('code') is-invalid-input @enderror input-underline" name="code" id="code" wire:model.defer="code" {{ $view == 'edit' ? 'disabled' : '' }} >
            <option value="">Seleccione una opción</option>
            @foreach($groups as $group)
                <option value="{{ $group->code }}">{{ $group->name }}:{{ $group->course->name }}</option>
            @endforeach
        </select>
        @error('code')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </label>
    <div class="block">
        <span class="text-gray-700">Correo institucional</span>
        <input type="text"
               class="@error('email') is-invalid-input @enderror input-underline" name="email" id="email" wire:model.defer="email" {{ $view == 'edit' ? 'disabled' : '' }}>
        @error('email')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <label class="block">
        <span class="text-gray-700">Rol</span>
        <select class="@error('rol') is-invalid-input @enderror input-underline" name="rol" id="rol" wire:model.defer="rol">
            <option value="">Seleccione una opción</option>
            @foreach($roles as $rol)
                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
            @endforeach
        </select>
        @error('rol')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </label>
    <label class="block">
        <span class="text-gray-700">Estado</span>
        <select class="@error('state') is-invalid-input @enderror input-underline" name="state" id="state" wire:model.defer="state">
            <option value="">Seleccione una opción</option>
            @foreach($states_badget as $state_badet)
                <option value="{{ $state_badet }}">{{ $state_badet }}</option>
            @endforeach
        </select>
        @error('state')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </label>
</div>
