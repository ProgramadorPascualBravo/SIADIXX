<table class="hover">
    <caption>Tabla de departamentos</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}</td>
                <td>
                    @if ($department->state == 1)
                        <span class="label"><i class="fi-check"></i> Activado</span>
                    @else
                        <span class="label"><i class="fi-x"></i> Desactivado</span>
                    @endif
                </td>                <td>
                    <div class="small button-group flex-end">
                        <button wire:click="edit({{ $department->id }})" class="primary button hollow open-form" data-open="form-edit">Editar</button>
                        @if ($department->state == 1)
                            <button wire:click="change_state({{ $department->id }})" class="primary button hollow">Desactivar</button>
                        @else
                            <button wire:click="change_state({{ $department->id }})" class="primary button hollow">Activar</button>
                        @endif
                        <button wire:click="destroy({{ $department->id }})" class="alert button hollow">Eliminar</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $departments->links('pagination.paginate') }}
