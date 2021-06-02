<div class="grid grid-cols-4 gap-4 px-4">
    <div class="col-span-2 p-2">
        <h2 class="font-bold text-xl">Datos del usuario</h2>
        <h2><b>Nombre :</b> {{ $student->name }} {{ $student->last_name }}</h2>
        <h2><b>Documento :</b> {{ $student->document }} </h2>
        <h2><b>Correo :</b> {{ $student->email }} </h2>
        <h2><b>Estado :</b> {!! $student->state == 1 ? "<span class='text-green-400 font-bold'>Activo</span>" : "<span class='text-red-400 font-bold'>Desactivado</span>" !!} </h2>
        <h2><b>Creado en SIADI :</b> {{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $student->created_at)->format('d-m-Y') }} </h2>

    </div>
    <div class="col-span-2 gap-2">
        <h2 class="font-bold text-xl mb-2">Datos de campus</h2>
        @if ($student->user_external)
        {{-- <h2><b>Programa :</b> {{ $enrollments[0]->group->course->program->name }}</h2> --}}
            <h2><b>Primer ingreso a campus</b> {{ $student->user_external->first_entry }}</h2>
            <h2><b>Último ingreso a campus</b> {{ $student->user_external->last_entry }}</h2>
        @else
            <span class="bg-yellow-400 p-2 w-auto">Nunca a ingresado al campus <i class="fi-alert"></i></span>
        @endif
    </div>
    <div class="col-span-4">
        <livewire:student-enrollment-table :params="$student->email" />
    </div>
</div>