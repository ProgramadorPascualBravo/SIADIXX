<div>
    <div class="grid-x">
        @include('sessions.session')
        <div class="medium-12 cell text-right">
            <button class="button" wire:click="cancel">Agregar nuevo registro</button>
        </div>
        <div class="medium-8 cell content-table">
            <livewire:enrollment-table />
        </div>
        <div class="medium-3 cell medium-offset-1">
            @include("livewire.enrollment.$view")
        </div>
    </div>
