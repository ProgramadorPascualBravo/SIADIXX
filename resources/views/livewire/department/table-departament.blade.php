<table class="hover">
    <caption>Tabla de departamentos</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($departaments as $departament)
            <tr>
                <td>{{ $departament->id }}</td>
                <td>{{ $departament->name }}</td>
                <td>
                    <div class="small button-group flex-end">
                        <button wire:click="edit({{ $departament->id }})" class="primary button hollow open-form" data-open="form-edit">Editar</button>
                        <button wire:click="destroy({{ $departament->id }})" class="alert button hollow">Eliminar</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $departaments->links('pagination.paginate') }}
