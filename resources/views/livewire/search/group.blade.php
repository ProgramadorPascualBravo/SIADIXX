<div class="grid grid-cols-4 gap-4">
    @include('fragments.search-form')
    <div class="col-span-4">
        @if($search_table != '' and $view == 'group')
            <livewire:group-search-table :params="$search_table" />
        @endif
    </div>
</div>