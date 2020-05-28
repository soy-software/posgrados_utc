<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <button type="button" onclick="location.href='{{ route('editarMallaCurricular',$malla->id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
        <i class="fas fa-edit"></i>
    </button>

    <button type="button" onclick="eliminar(this);" data-url="{{ route('eliminarMallaCurricular',$malla->id) }}" data-msg="{{ $malla->materia->nombre }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
        <i class="fas fa-trash"></i>
    </button>
</div>