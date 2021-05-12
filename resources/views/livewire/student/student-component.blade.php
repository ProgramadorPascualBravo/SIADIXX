<div>
    @include("sessions.session-input")
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-4 text-right pr-4">
            <a href="{{ route('student-mass-creation') }}" class="btn w-max bg-gray-800 text-white">Creacíón masivamente</a>
        </div>
        <div class="col-span-3 pl-4">
            <livewire:student-table />
        </div>
        <div class="col-span-1">
            @include("livewire.student.$view")
        </div>
    </div>
</div>
