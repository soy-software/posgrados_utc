<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    <button type="button" onclick="verFormulario(this);" data-msg="Formulario de registro {{ $reg->user->apellidos_nombres }}" data-url="{{ route('verFormularioRegistroPdf',$reg->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Ver formulario">
        <i class="far fa-address-book"></i>
    </button>
</div>