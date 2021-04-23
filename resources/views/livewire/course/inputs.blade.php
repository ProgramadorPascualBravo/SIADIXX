<div class="grid grid-cols-1 gap-2">
    <div class="block">
        <span class="text-gray-700">Nombres</span>
        <input type="text"
               class="@error('name') is-invalid-input @enderror input-underline" name="name" id="name" wire:model.defer="name">
        @error('name')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="block">
        <span class="text-gray-700">Código</span>
        <input type="text"
               class="@error('code') is-invalid-input @enderror input-underline" name="code" id="code" wire:model.defer="code">
        @error('code')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <label class="block">
        <span class="text-gray-700">Programa</span>
        <select class="@error('program_id') is-invalid-input @enderror input-underline" name="program_id" id="program_id" wire:model.defer="program_id">
            <option value="">Seleccione una opción</option>
            @foreach($programs as $program)
                <option value="{{ $program->id }}">{{ $program->name }}</option>
            @endforeach
        </select>
        @error('program_id')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </label>
    <label class="block">
        <span class="text-gray-700">Estado</span>
        <select class="@error('state') is-invalid-input @enderror input-underline" name="state" id="state" wire:model.defer="state">
            <option value="">Seleccione una opción</option>
            <option value="1">Activo</option>
            <option value="0">Desactivado</option>
        </select>
        @error('state')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </label>
</div>
