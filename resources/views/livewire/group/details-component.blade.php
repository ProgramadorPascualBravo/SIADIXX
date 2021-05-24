<div class="grid grid-cols-4 gap-4 px-4">
    <div class="col-span-2 p-2">
        <h2 class="font-bold text-xl">Datos del grupo</h2>
        <h2><b>Nombre : </b> Grupo{{ $group->name }}</h2>
        <h2><b>Código :</b> {{ $group->code }} </h2>
        <h2><b>Estado :</b> {!! $group->state == 1 ? "<span class='text-green-400 font-bold'>Activo</span>" : "<span class='text-red-400 font-bold'>Desactivado</span>" !!} </h2>
        <h2><b>Creado en SIADI :</b> {{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $group->created_at)->format('d-m-Y') }} </h2>
    </div>
    <div class="col-span-2 gap-2 text-right">
        <a href="{{ route('course-detail', ['id' => $group->course_id]) }}" class="btn border-gray-400 border-2 text-gray-500 hover:bg-gray-200">
            Ver detalle de la asignatura - <b>{{ $group->course->name }} <i class="fi-play"></i></b>
        </a>
    </div>
    <div class="col-span-4">
        <h2 class="font-bold text-xl">Lista de usuarios</h2>
        <div class="w-full my-4">
            <livewire:group-enrollment-table :params="$group->code" />
        </div>
    </div>
</div>