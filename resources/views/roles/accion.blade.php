<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    @can('eliminar', $rol)
        <button type="button" onclick="eliminar(this);" data-url="{{ route('eliminarRol',$rol->id) }}" data-msg="{{ $rol->name }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
            <i class="fas fa-trash"></i>
        </button>    
    @endcan
    
    
    <button type="button" class="btn btn-info btn-sm" onclick="location.href='{{ route('permisos',$rol->id) }}'" data-toggle="tooltip" data-placement="top" title="Permisos">
        <i class="fas fa-user-tag"></i>
    </button>
  </div>