<div class="grid grid-cols-1 gap-2">
    <div class="block">
        <span class="text-gray-700">Nombres</span>
        <input type="text"
               class="@error('name') is-invalid-input @enderror input-underline" name="name" id="name" wire:model.defer="name" autocomplete="off">
        @error('name')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="block">
        <span class="text-gray-700">Apellidos</span>
        <input type="text"
               class="@error('last_name') is-invalid-input @enderror input-underline" name="last_name" id="last_name" wire:model.defer="last_name" autocomplete="off">
        @error('last_name')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="block">
        <span class="text-gray-700">Email</span>
        <input type="text"
               class="@error('email') is-invalid-input @enderror input-underline" name="email" id="email" wire:model.defer="email" autocomplete="off">
        @error('username')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="block">
        <span class="text-gray-700">Documento</span>
        <input type="text"
               class="@error('document') is-invalid-input @enderror input-underline" name="document" id="document" wire:model.defer="document" autocomplete="off">
        @error('document')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    {{-- <div class="medium-12 cell">
        <label for="department_id">Departamento
            <select class="@error('department_id') is-invalid-input @enderror" name="department_id" id="department_id" wire:model.defer="department_id">
                <option value="">Seleccione una opción</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            @error('department_id')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div> --}}
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
