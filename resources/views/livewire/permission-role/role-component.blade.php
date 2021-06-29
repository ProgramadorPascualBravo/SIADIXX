<div>
    @include("sessions.session-input")
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-2 col-start-2 my-3">
                <h2 class="font-normal text-2xl mb-4 border-b-2 border-siadi-blue-300 w-max m-auto">Selecciona un usuario</h2>
                <label class="block w-96 m-auto">
                    <span class="text-gray-700">Usuario</span>
                    <select class="@error('user_id') is-invalid-input @enderror input-underline" name="user_id" id="user_id" wire:model.defer="user_id" wire:change="change">
                        <option value="">Seleccione una opción</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <span class="form-error text-red-700 is-visible">{{ $message }}</span>
                    @enderror
                </label>

        </div>
        <div class="col-span-4 pl-4 mt-1 flex flex-row-reverse px-4">
            @if($view == 'create')
                <button class="btn btn-blue inline-flex" type="submit" wire:click="store">Crear</button>
            @else
                <button class="btn btn-blue inline-flex" type="submit" wire:click="update">Actualizar</button>
            @endif
            <div class="flex flex-col">
                <input type="text"
                       class="@error('name') border-2 border-solid @enderror inline-flex" name="name" id="name" wire:model.defer="name">
                @error('name')
                    <span class="form-error text-red-700 is-visible">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-span-4 px-4">
            <livewire:role-table />
        </div>
    </div>
</div>