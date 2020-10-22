<div>
    <div class="grid-x">
        @include('sessions.session')
        <div class="medium-12 cell text-right">
            <button class="button open-form" data-open="form-create" >Agregar nuevo registro</button>
        </div>
        <div class="medium-12 cell content-table">
            @include('livewire.user.table-user')
        </div>
    </div>
    <div id="modals">
        @include("livewire.user.$view")
    </div>
</div>
