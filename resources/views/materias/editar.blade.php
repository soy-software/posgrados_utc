@extends('layouts.app',['title'=>'Editar matería'])
@section('breadcrumbs', Breadcrumbs::render('editarMateria',$materia))
@section('content')
<div class="card">
    
    <div class="card-body">
        <form method="POST" action="{{ route('actualizarMateria') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $materia->id }}">
            <div class="md-form ">
                <i class="far fa-address-book prefix"></i>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre',$materia->nombre) }}" class="form-control @error('nombre') is-invalid @enderror"  required>
                <label for="nombre">Nombre de matería<strong class="text-danger">*</strong></label>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Guardar
            </button>
        </form>
    </div>
</div>


@prepend('scriptsHeader')

@endprepend

@push('scriptsFooter')
    <script>
        $('#menuMaestrias').addClass('active')
    </script>
@endpush
@endsection
