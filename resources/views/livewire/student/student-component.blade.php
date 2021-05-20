<div>
    @include("sessions.session-input")
    <div class="grid grid-cols-4 gap-2">
        @can('moodle-massive')
            <div class="col-span-4 text-right pr-4">
                <a href="{{ route('student-mass-creation') }}" class="btn w-max bg-gray-800 text-white">Creacíón masivamente</a>
            </div>
        @endcan
        <div class="@cannot('moodle_write') col-span-4 px-4 @endcan col-span-3 pl-4">
            <livewire:student-table />
        </div>
        @can('moodle_write')
            <div class="col-span-1">
                @include("livewire.student.$view")
            </div>
        @endcan
    </div>
</div>
