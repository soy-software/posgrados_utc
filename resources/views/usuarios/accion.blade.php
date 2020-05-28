<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <button type="button" onclick="location.href='{{ route('editarUsuario',$user->id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
        <i class="fas fa-edit"></i>
    </button>

    @can('eliminar', $user)
    <button type="button" onclick="eliminar(this);" data-url="{{ route('eliminarUsuario',$user->id) }}" data-msg="{{ $user->email }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
        <i class="fas fa-trash"></i>
    </button>
    @endcan

   
</div>