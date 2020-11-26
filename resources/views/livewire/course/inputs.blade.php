<div class="medium-12 cell">
    <label for="name">Nombre<input class="@error('name') is-invalid-input @enderror" type="text" name="name" id="name" wire:model.defer="name"></label>
    @error('name')
    <span class="form-error is-visible">{{ $message }}</span>
    @enderror

    <label for="codigo">Código<input class="@error('code') is-invalid-input @enderror" type="text" name="codigo" id="codigo" wire:model.defer="code"></label>
    @error('code')
    <span class="form-error is-visible">{{ $message }}</span>
    @enderror

    <div class="medium-12 cell">
        <label for="program_id">Programa
            <select class="@error('department_id') is-invalid-input @enderror" name="program_id" id="program_id" wire:model.defer="program_id">
                <option value="">Seleccione una opción</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                @endforeach
            </select>
            @error('program_id')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>

    <div class="medium-12 cell">
        <label for="department_id">Moodle
            <select class="@error('moodle_id') is-invalid-input @enderror" name="moodle_id" id="moodle_id" wire:model.defer="moodle_id">
                <option value="">Seleccione una opción</option>
                <option value="1">Pregrado</option>
                <option value="2">Inglés</option>
                <option value="3">Posgrado</option>
            </select>
            @error('moodle_id')
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
