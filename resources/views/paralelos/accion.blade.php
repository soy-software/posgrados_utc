<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <button type="button" onclick="eliminar(this);" data-url="{{ route('eliminarParalelo',$paralelo->id) }}" data-msg="{{ $paralelo->nombre }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
        <i class="fas fa-trash"></i>
    </button>
    <button type="button" onclick="location.href='{{ route('editarParalelo',$paralelo->id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
        <i class="fas fa-edit"></i>
    </button>
    
    <button type="button" onclick="location.href='{{ route('mallaCurricular',$paralelo->id) }}'" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Malla curricular">
        <i class="fas fa-clipboard-list"></i>
    </button>
</div>