<div class="grid px-5 grid-cols-4 gap-4">
    @include("sessions.session-input")
    <div class="col-span-4 flex flex-row-reverse">
        <button class="btn btn-red w-auto" wire:click="cancel">
            Reiniciar
        </button>
        <button class="btn btn-green w-auto" wire:click="download('app/file/anexo-1.xlsx')">
            Plantilla Básica
        </button>
    </div>

    <div class="col-span-1 flex justify-center flex-col items-center">
        <span>¿Anexo extendido?</span>
        <div class="flex m-2">
            <label for="anexo_user" class="mr-2">
                Sí
                <input type="radio" wire:model="anexo_user" name="anexo_user" value="1">
            </label>
            <label for="anexo_user" class="ml-2">
                No
                <input type="radio" wire:model="anexo_user" name="anexo_user" value="0">
            </label>
        </div>
        <form wire:submit.prevent="analyze"
              x-data="{ isUploading: false, progress: 0 }"
              x-on:livewire-upload-start="isUploading = true"
              x-on:livewire-upload-finish="isUploading = false"
              x-on:livewire-upload-error="isUploading = false"
              x-on:livewire-upload-progress="progress = $event.detail.progress"
        >
            <div x-show="isUploading" class="fixed left-0 -top-2.5 w-screen">
                <progress max="100" class="border-green-300 h-2 w-screen" x-bind:value="progress"></progress>
            </div>

            <div>
                <div class="flex w-full bg-grey-lighter">
                    <label class="w-60 @if($file) bg-green-200 @endif flex border-green-400 flex-col items-center px-4 py-6 bg-white text-green-900 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-green-200">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">
                            @if($file)

                                {{ $file->getClientOriginalName() }}
                            @else
                                Cargar archivo
                            @endif
                        </span>
                        <input type='file'  wire:model="file" name="file" class="hidden" />
                    </label>
                </div>
            </div>
            <div class="m-2">
                @error('file') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-center">
                <button class="btn btn-blue" type="submit">Procesar archivo cargado</button>
            </div>
        </form>
    </div>
    <div class="col-span-3 pl-2">
        @if(count($failures) > 0)
            <div>
                <p>Total de elementos {{ $quantity['processed'] + $quantity['mistakes'] }}</p>
                <p>Procesados: {{ $quantity['processed'] }}</p>
                <p>Errores: {{ $quantity['mistakes'] }}</p>
            </div>
        <div class="table align-middle min-w-full">
            <div class="table-row divide-x divide-gray-200">
                <div class="relative table-cell h-12 overflow-hidden align-top">
                    <button class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none ">
                        Nombres
                    </button>
                </div>
                <div class="relative table-cell h-12 overflow-hidden align-top">
                    <button class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none ">
                        Apellidos
                    </button>
                </div>
                <div class="relative table-cell h-12 overflow-hidden align-top">
                    <button class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none ">
                        Documento
                    </button>
                </div>
                <div class="relative table-cell h-12 overflow-hidden align-top">
                    <button class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none ">
                        Email
                    </button>
                </div>
                <div class="relative table-cell h-12 overflow-hidden align-top">
                    <button class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none ">
                        Mensajes
                    </button>
                </div>
            </div>
                @foreach($failures as $index => $failure)
                    <div class="table-row p-1 divide-x divide-gray-100  {{ $index%2==0? 'bg-gray-50' : 'bg-gray-100' }}">
                        <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell align-middle lowercase text-left">
                            {{ $failure["name"] }}
                        </div>
                        <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell align-middle lowercase text-left">
                            {{ $failure["last_name"] }}
                        </div>
                        <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell align-middle text-left">
                            {{ $failure["document"] }}
                        </div>
                        <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell align-middle lowercase text-left ">
                            {{ $failure["email"] }}
                        </div>
                        <div class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-900 table-cell lowercase text-left ">
                            <ul>
                                @foreach($failure["errors"] as $v)
                                    <li>{{ $v[0] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>