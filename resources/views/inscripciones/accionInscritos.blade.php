<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    
    <button type="button" onclick="location.href='{{ route('verInscripcion',$inscri->id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver">
        <i class="fas fa-eye"></i>
    </button>

    
    <button type="button" onclick="eliminar(this);" data-url="{{ route('eliminarInscripcion',$inscri->id) }}" data-msg="{{ $inscri->registro->user->apellidos_nombres }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
        <i class="fas fa-trash"></i>
    </button>

    
   
</div>