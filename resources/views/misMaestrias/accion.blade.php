<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <button type="button" onclick="location.href='{{ route('miCohorteRegistros',$coh->cohorte_id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Registros">
        <i class="fas fa-user-edit"></i>
    </button>
    <button type="button" onclick="location.href='{{ route('miCohorteInscritos',$coh->cohorte_id) }}'" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Inscripciones">
        <i class="fas fa-user-check"></i>
    </button>
    <button type="button" onclick="location.href='{{ route('miCohorteAdmision',$coh->cohorte_id) }}'" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Admisiones">
        <i class="fas fa-user-shield"></i>
        
    </button>
    
</div>