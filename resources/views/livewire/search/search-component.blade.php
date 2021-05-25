<div class="grid grid-cols-4 gap-2">
    <div class="col-span-2 col-start-2 text-center pt-4">
        <button wire:click="change('student')" class="btn border-gray-400 border-2 text-gray-500 hover:bg-gray-200
            {{ $view == 'student' ? 'bg-gray-200' : '' }}">
            Usuarios
        </button>
        <button wire:click="change('program')" class="btn border-gray-400 border-2 text-gray-500 hover:bg-gray-200
            {{ $view == 'program' ? 'bg-gray-200' : '' }}">
            Programas
        </button>
        <button wire:click="change('course')" class="btn border-gray-400 border-2 text-gray-500 hover:bg-gray-200
            {{ $view == 'course' ? 'bg-gray-200' : '' }}">
            Asignaturas
        </button>
        <button wire:click="change('group')" class="btn border-gray-400 border-2 text-gray-500 hover:bg-gray-200
            {{ $view == 'group' ? 'bg-gray-200' : '' }}">
            Grupos
        </button>
        <button wire:click="change('enrollment')" class="btn border-gray-400 border-2 text-gray-500 hover:bg-gray-200
            {{ $view == 'enrollment' ? 'bg-gray-200' : '' }}">
            Matrículas
        </button>
    </div>
    @if(!empty($view))
        <div class="col-span-4 px-2">
            @include("livewire.search.$view")
        </div>
    @endif
</div>
