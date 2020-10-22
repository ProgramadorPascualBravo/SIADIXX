<table class="hover">
    <caption>Lista de usuarios</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Usuario</th>
            <th>Departamento</th>
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
                <td>{{ $user->departament->name }}</td>
                <td>
                    <div class="small button-group">
                        <button wire:click="edit({{ $user->id }})" class="primary button hollow open-form" data-open="form-edit">Editar</button>
                        <button wire:click="destroy({{ $user->id }})" class="alert button hollow">Eliminar</button>
                    </div>
                </td>
                <td>
                    <div class="small button-group">
                        <button class="alert button hollow">Eliminar</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links('pagination.paginate') }}
