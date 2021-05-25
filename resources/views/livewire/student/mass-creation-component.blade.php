<div class="grid px-5 grid-cols-4 gap-4">
    @include("sessions.session-input")
    <div class="col-span-4 flex flex-row-reverse">
        <button class="btn btn-red w-auto" wire:click="cancel">
            Reiniciar
        </button>
        <button class="btn btn-green w-auto" wire:click="download('app/file/anexo-1.xlsx')">
            Plantilla Básica
            <svg class="h-5 w-5 stroke-current m-2" fill="none" viewBox="0 0 384 512"><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm212-240h-28.8c-4.4 0-8.4 2.4-10.5 6.3-18 33.1-22.2 42.4-28.6 57.7-13.9-29.1-6.9-17.3-28.6-57.7-2.1-3.9-6.2-6.3-10.6-6.3H124c-9.3 0-15 10-10.4 18l46.3 78-46.3 78c-4.7 8 1.1 18 10.4 18h28.9c4.4 0 8.4-2.4 10.5-6.3 21.7-40 23-45 28.6-57.7 14.9 30.2 5.9 15.9 28.6 57.7 2.1 3.9 6.2 6.3 10.6 6.3H260c9.3 0 15-10 10.4-18L224 320c.7-1.1 30.3-50.5 46.3-78 4.7-8-1.1-18-10.3-18z"></path></svg>
        </button>
    </div>

    <div class="col-span-1 flex flex-col items-center">
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
                <button class="btn btn-blue {{ $process == true ? 'bg-blue-300' : '' }}" type="submit">
                    Procesar archivo cargado
                    @if ($process)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    @endif
                </button>
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