<div>
    <div class="medium-12 cell">
        <label for="name">Nombre<input class="@error('name') is-invalid-input @enderror" type="text" name="name" id="name" wire:model.defer="name"></label>
        @error('name')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="last_name">Apellido<input class="@error('last_name') is-invalid-input @enderror" type="text" name="last_name" id="last_name" wire:model.defer="last_name"></label>
        @error('last_name')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="username">Usuario<input class="@error('username') is-invalid-input @enderror" type="text" name="username" id="username" wire:model.defer="username"></label>
        @error('username')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="department_id">Departamento
            <select class="@error('department_id') is-invalid-input @enderror" name="department_id" id="department_id" wire:model.defer="department_id">
                <option value selected disabled>Seleccione un departamento</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        @error('department_id')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
</div>
