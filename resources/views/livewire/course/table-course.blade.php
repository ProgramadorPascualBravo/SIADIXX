<table class="hover">
    <caption>Tabla de cursos</caption>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Código SICAU</th>
        <th>Facultad</th>
        <th>Departamento</th>
        <th>Moodle</th>
        <th class="text-center">Estado
            <i
                data-tooltip tabindex="1"
                title="Muestra los estados de activado o desactivado."
                data-position="top"
                data-alignment="center"
                data-to class="fi-info"
            ></i></th>
        <th colspan="2">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->codigo }}</td>
            <td>{{ $course->program->faculty }}</td>
            <td>{{ $course->program->name }}</td>
            <td>{{ $course->moodle_id }}</td>
            <td class="text-center">
                @if ($course->state == 1)
                    <span class="label"><i class="fi-check"></i> Activado</span>
                @else
                    <span class="label"><i class="fi-x"></i> Desactivado</span>
                @endif
            </td>
            <td>
                <div class="small button-group flex-end align-center-middle margin-0">
                    <button wire:click="edit({{ $course->id }})" class="primary button hollow open-form" data-open="form-edit">Editar</button>
                    @if ($course->state == 1)
                        <button wire:click="change_state({{ $course->id }})" class="primary button hollow">Desactivar</button>
                    @else
                        <button wire:click="change_state({{ $course->id }})" class="primary button hollow">Activar</button>
                    @endif
                    <button wire:click="destroy({{ $course->id }})" class="alert button hollow">Eliminar</button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $courses->links('pagination.paginate') }}
