<div class="text-right my-4 flex flex-row-reverse">
    <button class="btn btn-green mr-0" wire:click="store">
        @if($process)
            Guardando
            <x-icons.cog wire:loading class="h-4 w-4  animate-spin text-gray-400" style="display: inline-block" />
        @else
            Guardar
        @endif
    </button>
    <button class="btn btn-red" wire:click="cancel">
        <span>Cancelar</span>
    </button>
</div>