<table class="hover">
    <caption>Tabla de programas</caption>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Facultad</th>
        <th>Departamento</th>
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
    @foreach($programs as $program)
        <tr>
            <td>{{ $program->id }}</td>
            <td>{{ $program->name }}</td>
            <td>{{ $program->faculty }}</td>
            <td>{{ $program->departament->name }}</td>
            <td class="text-center">
                @if ($program->state == 1)
                    <span class="label"><i class="fi-check"></i> Activado</span>
                @else
                    <span class="label"><i class="fi-x"></i> Desactivado</span>
                @endif
            </td>
            <td>
                <div class="small button-group flex-end align-center-middle margin-0">
                    <button wire:click="edit({{ $program->id }})" class="primary button hollow open-form" data-open="form-edit">Editar</button>
                    @if ($program->state == 1)
                        <button wire:click="change_state({{ $program->id }})" class="primary button hollow">Desactivar</button>
                    @else
                        <button wire:click="change_state({{ $program->id }})" class="primary button hollow">Activar</button>
                    @endif

                    <button wire:click="destroy({{ $program->id }})" class="alert button hollow">Eliminar</button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $programs->links('pagination.paginate') }}
