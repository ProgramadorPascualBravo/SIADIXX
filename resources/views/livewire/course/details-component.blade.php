<div class="grid grid-cols-4 gap-4 px-4">
    <div class="col-span-2 p-2">
        <h2 class="font-bold text-xl">Datos de la asignatura</h2>
        <h2><b>Nombre :</b> {{ $course->name }}</h2>
        <h2><b>Código :</b> {{ $course->code }} </h2>
        <h2><b>Estado :</b> {!! $course->state == 1 ? "<span class='text-green-400 font-bold'>Activo</span>" : "<span class='text-red-400 font-bold'>Desactivado</span>" !!} </h2>
        <h2><b>Creado en SIADI :</b> {{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $course->created_at)->format('d-m-Y') }} </h2>
    </div>
    <div class="col-span-2 text-right">
        <a href="{{ route('program-detail', ['id' => $course->program_id]) }}" class="btn border-gray-400 border-2 text-gray-500 hover:bg-gray-200">
            Ver detalle del programa-<b>{{ $course->program->name }} <i class="fi-play"></i></b>
        </a>
    </div>
    <div class="col-span-4">
        <h2 class="font-bold text-xl">Lista de grupos</h2>
        <div class="w-full my-4">
            @foreach($course->groups->reverse() as $group)
                <div x-data={show:false} class="rounded-sm">
                    <div class="border border-b-0" id="headingOne">
                        <button @click="show=!show"  class="block w-full h-full font-bold text-white text-left px-10 py-6 focus:outline-none bg-gray-300"  :class="{ 'bg-gray-800': show === true }"type="button">
                            Grupo: {{ $group->name }}
                        </button>
                    </div>
                    <div x-show="show" class="border border-b-0 px-10 py-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1">
                                <p><b>Codigo:</b> {{ $group->code }} </p>
                                <h2><b>Estado:</b> {!! $group->state == 1 ? "<span class='text-green-400 font-bold'>Activo</span>" : "<span class='text-red-400 font-bold'>Desactivado</span>" !!} </h2>
                            </div>
                            <div class="col-span-1">
                                <h2><b>Creado en SIADI :</b> {{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $group->created_at)->format('d-m-Y') }} </h2>
                                <p class="mt-2"><b>Matrículas en moodle:</b> <span class="px-2 py-1 bg-green-700 text-white font-bold">{{ $group->enrollments_moodle->count() ?? 0 }}</span></p>
                            </div>
                            <div class="col-span-2">
                                <h2 class="font-bold text-xl">Lista de matrículados</h2>
                                <livewire:group-enrollment-table :params="$group->code" />
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
