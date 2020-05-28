<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <button type="button" onclick="eliminar(this);" data-url="{{ route('eliminarMaestria',$maestria->id) }}" data-msg="{{ $maestria->nombre }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
        <i class="fas fa-trash"></i>
    </button>
    <button type="button" onclick="location.href='{{ route('editarMaestria',$maestria->id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
        <i class="fas fa-edit"></i>
    </button>

    <button type="button" onclick="location.href='{{ route('materias',$maestria->id) }}'" class="btn btn-deep-purple btn-sm" data-toggle="tooltip" data-placement="top" title="Materías">
        <i class="far fa-address-book text-white"></i>
    </button>

    <button type="button" onclick="location.href='{{ route('cohortes',$maestria->id) }}'" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Cohortes">
        <i class="fas fa-clipboard-list"></i>
    </button>
    

</div>