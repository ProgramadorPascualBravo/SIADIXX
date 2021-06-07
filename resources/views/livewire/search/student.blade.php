<div class="grid grid-cols-4 gap-4">
    @include('fragments.search-form')
    <div class="col-span-4">
        <h3 class="text-center font-bold text-2xl">Criterio de búsqueda</h3>
        <p class="text-center">
            Buscar por nombres, apellidos, correo institucional y documento de identidad.
        </p>
        <br>
        @if($search_table != '' and $view == 'student')
            <livewire:student-search-table :params="$search_table" />
        @endif
    </div>
</div>