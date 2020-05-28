<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <button type="button" onclick="verFormulario(this);" data-msg="Formulario de inscripción {{ $inscri->user->apellidos_nombres }}" data-url="{{ route('verHojaVidaInscripcionMisMaestrias',$inscri->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver hoja de vida">
        <i class="far fa-address-book"></i>
    </button>
</div>