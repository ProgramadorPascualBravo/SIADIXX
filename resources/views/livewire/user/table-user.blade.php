<table class="hover">
    <caption>Lista de usuarios</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Usuario</th>
            <th>Departamento</th>
            <th>Estado</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id  }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->department->name }}</td>
                <td>
                    @if ($user->state == 1)
                        <span class="label"><i class="fi-check"></i> Activado</span>
                    @else
                        <span class="label"><i class="fi-x"></i> Desactivado</span>
                    @endif
                </td>
                <td>
                    <div class="small button-group">
                        <button wire:click="edit({{ $user->id }})" class="primary button hollow open-form" data-open="form-edit">Editar</button>
                        @if ($user->state == 1)
                            <button wire:click="change_state({{ $user->id }})" class="primary button hollow">Desactivar</button>
                        @else
                            <button wire:click="change_state({{ $user->id }})" class="primary button hollow">Activar</button>
                        @endif
                        <button wire:click="destroy({{ $user->id }})" class="alert button hollow">Eliminar</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links('pagination.paginate') }}
