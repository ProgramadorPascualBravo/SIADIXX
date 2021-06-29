<div>
    @include("sessions.session-input")
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-2 col-start-2 my-3">
                <h2 class="font-normal text-2xl mb-4 w-min border-b-2 border-siadi-blue-300 m-auto">Información</h2>
                <label class="block w-72 m-auto">
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
            @if($view == 'create')
                <button class="btn btn-blue inline-flex" type="submit" wire:click="store">Crear</button>
            @else
                <button class="btn btn-blue inline-flex" type="submit" wire:click="update">Actualizar</button>
            @endif
                <input type="text"
                   class="@error('name') is-invalid-input @enderror inline-flex" name="name" id="name" wire:model.defer="name">
        </div>
        <div class="col-span-4 px-4">
            <livewire:permission-table />
        </div>
    </div>
</div>