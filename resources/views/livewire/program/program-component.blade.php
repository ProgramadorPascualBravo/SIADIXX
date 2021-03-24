<div>
    <div class="grid-x">
        @include('sessions.session')
        <div class="medium-12 cell text-right">
            <button class="button" wire:click="cancel">Agregar nuevo registro</button>
        </div>
        <div class="medium-6 cell content-table">
            <livewire:program-table />
        </div>
        <div class="medium-5 cell medium-offset-1">
            @include("livewire.program.$view")
        </div>
    </div>
