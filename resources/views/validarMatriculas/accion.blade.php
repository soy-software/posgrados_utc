<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
    
    <button type="button" data-msg="{{ $admi->user->apellidos_nombres }}" data-factura="{{ $admi->factura }}" onclick="validar(this);" data-id="{{ $admi->id }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Validar matrícula">
        <i class="fas fa-clipboard-check"></i>
    </button>

</div>