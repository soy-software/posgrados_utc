@extends('layouts.app',['title'=>'Editar paralelo'])
@section('breadcrumbs', Breadcrumbs::render('editarParalelo',$paralelo))
@section('content')
<div class="card">
    
    <div class="card-body">
        <form method="POST" action="{{ route('actualizarParalelo') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $paralelo->id }}">

            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="fas fa-door-open prefix"></i>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre',$paralelo->nombre) }}" class="form-control @error('nombre') is-invalid @enderror"  required>
                    <label for="nombre">Nombre de paralelo<strong class="text-danger">*</strong></label>
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            

                <div class="md-form col-md-4">
                    <i class="fas fa-calendar-alt prefix"></i>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio',$paralelo->fecha_inicio) }}" class="form-control @error('fecha_inicio') is-invalid @enderror">
                    <label for="fecha_inicio">Fecha de inicio</label>
                    @error('fecha_inicio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="md-form col-md-4">
                    <i class="fas fa-calendar-alt prefix"></i>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin',$paralelo->fecha_fin) }}" class="form-control @error('fecha_fin') is-invalid @enderror">
                    <label for="fecha_fin">Fecha de fin</label>
                    @error('fecha_fin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
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
