@if (Storage::exists($reg->foto))
<a href="{{ Storage::url($reg->foto) }}" class="my-0 mb-0 mt-0" data-toggle="lightbox" data-title="Comprobante de registro" data-footer="{{ $reg->cohorte->maestria->nombre }} COHORTE {{ $reg->cohorte->numero }}">
    <img src="{{ Storage::url($reg->foto) }}" class="img-fluid my-0 mb-0 mt-0" width="30px">
</a>
@else
    <span class="badge badge-info">Sin comprobante</span>
@endif