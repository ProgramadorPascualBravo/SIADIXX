<div>
    @include("sessions.session-input")
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-2 col-start-2 my-3">
                <h2 class="text-2xl mb-4 text-center">Selecciona un Rol</h2>
                <label class="block my-4">
                    <span class="text-gray-700">Rol</span>
                    <select class="@error('rol_id') is-invalid-input @enderror input-underline" name="rol_id" id="rol_id" wire:model.defer="rol_id" wire:change="change">
                        <option value="">Seleccione una opción</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                    @error('rol')
                    <span class="form-error is-visible">{{ $message }}</span>
                    @enderror
                </label>
        </div>
        <div class="col-span-4 pl-4 mt-1 flex flex-row-reverse">
            <button class="btn btn-blue inline-flex" wire:click="update">Actualizar</button>
            <input type="text"
                   class="@error('name') is-invalid-input @enderror inline-flex" name="name" id="name" wire:model.defer="name">
        </div>
        <div class="col-span-4 px-4">
            <livewire:permission-table />
        </div>
    </div>
</div>