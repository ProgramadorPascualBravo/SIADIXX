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
            <button class="btn btn-blue" type="submit" wire:loading.attr="disabled">
                Procesar archivo cargado
            </button>
        </div>
    </form>
    <div wire:loading wire:target="file" class="text-center bg-green-800-600 font-bold text-white my-4 p-3">
        Subiendo archivo
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-ping" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
        </svg>
    </div>
    <div wire:loading wire:target="analyze" class="text-center bg-blue-600 font-bold text-white my-4 p-3">
        Procesando archivo
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
    </div>
</div>
