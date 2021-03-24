<div>
    <div class="grid-x">
        @include('sessions.session')
        <div class="medium-12 cell text-right">
            <button class="button" wire:click="cancel" >Agregar nuevo registro</button>
        </div>
        <div class="medium-8 cell content-table">
            <livewire:user-table />
        </div>
        <div class="medium-3 cell medium-offset-1">
            @include("livewire.user.$view")
        </div>
    </div>
</div>
