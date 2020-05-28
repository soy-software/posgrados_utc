<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <button type="button" onclick="eliminar(this);" data-url="{{ route('eliminarCohorte',$cohorte->id) }}" data-msg="{{ $cohorte->numero }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
        <i class="fas fa-trash"></i>
    </button>
    <button type="button" onclick="location.href='{{ route('editarCohorte',$cohorte->id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
        <i class="fas fa-edit"></i>
    </button>
    <button type="button" onclick="location.href='{{ route('paralelos',$cohorte->id) }}'" class="btn btn-deep-purple btn-sm" data-toggle="tooltip" data-placement="top" title="Paralelos">
        <i class="fas fa-door-open text-white"></i>
    </button>
    <button type="button" onclick="location.href='{{ route('bancoPreguntas',$cohorte->id) }}'" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Batería de preguntas">
        <i class="fas fa-tasks"></i>
    </button>
    <button type="button" onclick="location.href='{{ route('admision',$cohorte->id) }}'" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Admisíon">
        <i class="fas fa-user-graduate"></i>
    </button>
</div>