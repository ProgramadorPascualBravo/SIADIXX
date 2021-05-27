<div class="grid grid-cols-5 gap-4 px-4">
    @include("sessions.session-input")
    <div class="col-span-3 col-start-2 p-2">
        <div class="grid grid-cols-2 gap-4 px-4">
            <div class="col-span-1">
                <h2><b>Nombres y Apellidos :</b> {{ $user->full_name }}</h2>
                <h2><b>Documento :</b> {{ $user->document }} </h2>
                <h2><b>Correo :</b> {{ $user->username }} </h2>
                <h2><b>Categoria :</b> {{ Auth::user()->department->name }}</h2>
                <h2><b>Estado :</b> {!! $user->state == 1 ? "<span class='text-green-400 font-bold'>Activo</span>" : "<span class='text-red-400 font-bold'>Desactivado</span>" !!} </h2>
                <h2><b>Creado en SIADI :</b> {{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d-m-Y') }} </h2>
                <h2><b>Cuenta verificada :</b> {!! $user->verified == 1 ? "<span class='text-green-400 font-bold'>Verificado</span>" : "<span class='text-red-400 font-bold'>No Verificado</span>" !!}</h2>
                <h2><b>Fecha de verificación :</b> {{ $user->verified == 1 ? \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $user->email_verified_at)->format('d-m-Y') : "No hay registro" }} </h2>
            </div>
            <div class="col-span-1">
                <p><button class="btn btn-blue" style="margin-left: 0" wire:click="$toggle('change_password')">Cambiar contraseña</button></p>
                <br />
                @if($change_password)
                        <div class="block">
                            <span class="text-gray-700">Contraseña actual</span>
                            <input type="text"
                                   class="@error('password_current') is-invalid-input @enderror input-underline"
                                   name="password_current" id="password_current" wire:model.defer="password_current" autocomplete="off">
                            @error('password_current')
                            <span class="form-error is-visible">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="block">
                            <span class="text-gray-700">Nueva contraseña</span>
                            <input type="text"
                                   class="@error('password') is-invalid-input @enderror input-underline"
                                   name="password" id="password" wire:model.defer="password" autocomplete="off">
                            @error('password')
                            <span class="form-error is-visible">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="block">
                            <span class="text-gray-700">Confirmar contraseña</span>
                            <input type="text"
                                   class="@error('password_confirmation') is-invalid-input @enderror input-underline"
                                   name="password_confirmation" id="password_confirmation" wire:model.defer="password_confirmation" autocomplete="off">
                            @error('password_confirmation')
                                <span class="form-error is-visible">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-right my-4 flex flex-row-reverse">
                            <button class="btn btn-blue mr-0" wire:click="update">
                                <span>Actualizar</span>
                            </button>
                            <button class="btn btn-red" wire:click="$toggle('change_password')">
                                <span>Cancelar</span>
                            </button>
                        </div>
                @endif
            </div>
        </div>
    </div>
</div>