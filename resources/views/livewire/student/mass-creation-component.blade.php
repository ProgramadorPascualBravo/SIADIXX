<div class="grid px-5 grid-cols-5 gap-4">
    @include("sessions.session-input")
    <div class="col-span-5 flex flex-row-reverse">
        <button class="btn btn-red w-auto" wire:click="cancel">
            Reiniciar
        </button>
        <button class="btn btn-green w-auto" wire:click="download('app/file/anexo-1.xlsx')">
            Plantilla
            <svg class="h-5 w-5 stroke-current ml-2" fill="none" viewBox="0 0 384 512"><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm212-240h-28.8c-4.4 0-8.4 2.4-10.5 6.3-18 33.1-22.2 42.4-28.6 57.7-13.9-29.1-6.9-17.3-28.6-57.7-2.1-3.9-6.2-6.3-10.6-6.3H124c-9.3 0-15 10-10.4 18l46.3 78-46.3 78c-4.7 8 1.1 18 10.4 18h28.9c4.4 0 8.4-2.4 10.5-6.3 21.7-40 23-45 28.6-57.7 14.9 30.2 5.9 15.9 28.6 57.7 2.1 3.9 6.2 6.3 10.6 6.3H260c9.3 0 15-10 10.4-18L224 320c.7-1.1 30.3-50.5 46.3-78 4.7-8-1.1-18-10.3-18z"></path></svg>
        </button>
    </div>
    <div class="col-span-2 pl-2">
        <h2 class="font-bold text-2xl mb-4">Instrucciones</h2>
        <ol class="list-decimal pl-4">
            <li>
                Descargar
                <button class="btn btn-green w-auto"  wire:click="download('app/file/anexo-1.xlsx')">
                    Plantilla
                    <svg class="h-5 w-5 stroke-current ml-2" fill="none" viewBox="0 0 384 512"><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm212-240h-28.8c-4.4 0-8.4 2.4-10.5 6.3-18 33.1-22.2 42.4-28.6 57.7-13.9-29.1-6.9-17.3-28.6-57.7-2.1-3.9-6.2-6.3-10.6-6.3H124c-9.3 0-15 10-10.4 18l46.3 78-46.3 78c-4.7 8 1.1 18 10.4 18h28.9c4.4 0 8.4-2.4 10.5-6.3 21.7-40 23-45 28.6-57.7 14.9 30.2 5.9 15.9 28.6 57.7 2.1 3.9 6.2 6.3 10.6 6.3H260c9.3 0 15-10 10.4-18L224 320c.7-1.1 30.3-50.5 46.3-78 4.7-8-1.1-18-10.3-18z"></path></svg>
                </button>

            </li>
            <li>Cargar la plantilla en la opción <b class="uppercase">cargar archivo</b></li>
            <li>Procesar archivo con la opción <b class="uppercase">procesar archivo cargado</b></li>
            <li>
                Finalizado el proceso pueden surgir 2 escenarios:
                <ol class="list-decimal pl-4">
                    <li><b>Hay errores:</b> Se genera un documento excel con los registros que contienen incosistencias y no se pudieron guardar.</li>
                    <li><b>No hay errores:</b> No sé genera documento y sale un mensaje informando que todos los registros fueron existosos. </li>
                </ol>
            </li>
        </ol>
        <p><b>Nota:</b> Para cargar un nuevo archivo, usar la opcíon
            <button class="btn btn-red w-auto" wire:click="cancel">
                Reiniciar
            </button>
        </p>
    </div>
    <livewire:student-form-file-component />
    <div class="col-span-2">
        @if(!is_null($quantity))
            <h2 class="font-bold text-2xl mb-4">Resultados</h2>
            <p>
                <span class="block mb-2 w-max p-2 border-2 border-blue-600 font-bold text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Total de elementos {{ $quantity['processed'] + $quantity['mistakes'] }}
                </span>
            </p>
            @if($quantity['mistakes'] > 0)
                <p>
                <span class="block mb-2 w-max p-2 border-2 border-green-500 font-bold text-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Procesados: {{ $quantity['processed'] }}
                </span>
                </p>
                <p>
                <span class="block mb-2 w-max p-2 border-2 border-red-500 font-bold text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Errores: {{ $quantity['mistakes'] }}
                </span>
                </p>
            @else
                <div class="text-center bg-blue-600 font-bold text-white my-4 p-3">
                    Todos los registros fueron existosos
                </div>
            @endif
        @endif
    </div>
</div>
