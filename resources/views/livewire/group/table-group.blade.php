<table class="hover">
    <caption>Tabla de grupos</caption>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Código</th>
        <th>Curso</th>
        <th>Matrículas</th>
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
    @foreach($groups as $group)
        <tr>
            <td>{{ $group->id }}</td>
            <td>{{ $group->name }}</td>
            <td>{{ $group->code }}</td>
            <td>{{ $group->course->name }}</td>
            <td>12</td>
            <td class="text-center">
                @if ($group->state == 1)
                    <span class="label"><i class="fi-check"></i> Activado</span>
                @else
                    <span class="label"><i class="fi-x"></i> Desactivado</span>
                @endif
            </td>
            <td>
                <div class="small button-group flex-end align-center-middle margin-0">
                    <button wire:click="edit({{ $group->id }})" class="primary button hollow open-form" data-open="form-edit">Editar</button>
                    @if ($group->state == 1)
                        <button wire:click="change_state({{ $group->id }})" class="primary button hollow">Desactivar</button>
                    @else
                        <button wire:click="change_state({{ $group->id }})" class="primary button hollow">Activar</button>
                    @endif
                    <button wire:click="destroy({{ $group->id }})" class="alert button hollow">Eliminar</button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $groups->links('pagination.paginate') }}
