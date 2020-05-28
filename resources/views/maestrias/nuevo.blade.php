@extends('layouts.app',['title'=>'Nueva maestría'])
@section('breadcrumbs', Breadcrumbs::render('nuevaMaestria'))
@section('content')

<form action="{{ route('guardarMaestria') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
            
          
            <div class="form-row">
                <div class="md-form col-md-6">
                    <i class="fas fa-graduation-cap prefix"></i>
                    <input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autofocus>
                    <label for="nombre">Nombre de maestría<span class="text-danger">*</span></label>
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-6">
                    <i class="fas fa-user-graduate prefix"></i>
                    <input type="text" id="tipo_programa" class="form-control @error('tipo_programa') is-invalid @enderror" name="tipo_programa" value="{{ old('tipo_programa') }}">
                    <label for="tipo_programa">Tipo de programa</label>
                    @error('tipo_programa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="fas fa-book prefix"></i>
                    <input type="text" id="campo_amplio" class="form-control @error('campo_amplio') is-invalid @enderror" name="campo_amplio" value="{{ old('campo_amplio') }}">
                    <label for="campo_amplio">Campo amplio</label>
                    @error('campo_amplio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-book-reader prefix"></i>
                    <input type="text" id="campo_especifico" class="form-control @error('campo_especifico') is-invalid @enderror" name="campo_especifico" value="{{ old('campo_especifico') }}">
                    <label for="campo_especifico">Campo específico</label>
                    @error('campo_especifico')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-book-open prefix"></i>
                    <input type="text" id="campo_detallado" class="form-control @error('campo_detallado') is-invalid @enderror" name="campo_detallado" value="{{ old('campo_detallado') }}">
                    <label for="campo_detallado">Campo detallado</label>
                    @error('campo_detallado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="fas fa-atlas prefix"></i>
                    <input type="text" id="programa" class="form-control @error('programa') is-invalid @enderror" name="programa" value="{{ old('programa') }}">
                    <label for="programa">Programa</label>
                    @error('programa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-user prefix"></i>
                    <input type="text" id="titulo" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}">
                    <label for="titulo">Título</label>
                    @error('titulo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-barcode prefix"></i>
                    <input type="text" id="codificacion_programa" class="form-control @error('codificacion_programa') is-invalid @enderror" name="codificacion_programa" value="{{ old('codificacion_programa') }}">
                    <label for="codificacion_programa">Codificación programa</label>
                    @error('codificacion_programa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="fas fa-map-marker-alt prefix"></i>
                    <input type="text" id="lugar_ejecucion" class="form-control @error('lugar_ejecucion') is-invalid @enderror" name="lugar_ejecucion" value="{{ old('lugar_ejecucion') }}">
                    <label for="lugar_ejecucion">Lugar ejecución</label>
                    @error('lugar_ejecucion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-business-time prefix"></i>
                    <input type="text" id="duracion" class="form-control @error('duracion') is-invalid @enderror" name="duracion" value="{{ old('duracion') }}">
                    <label for="duracion">Duración</label>
                    @error('duracion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-calendar-alt prefix"></i>
                    <input type="text" id="tipo_periodo" class="form-control @error('tipo_periodo') is-invalid @enderror" name="tipo_periodo" value="{{ old('tipo_periodo') }}">
                    <label for="tipo_periodo">Tipo período</label>
                    @error('tipo_periodo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="far fa-clock prefix"></i>
                    <input type="number" id="numero_horas" class="form-control @error('numero_horas') is-invalid @enderror" name="numero_horas" value="{{ old('numero_horas') }}">
                    <label for="numero_horas">Número de horas</label>
                    @error('numero_horas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="far fa-credit-card prefix"></i>
                    <input type="text" id="resolucion" class="form-control @error('resolucion') is-invalid @enderror" name="resolucion" value="{{ old('resolucion') }}">
                    <label for="resolucion">Resolución</label>
                    @error('resolucion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-calendar-alt prefix"></i>
                    <input type="date" id="fecha_resolucion" class="form-control @error('fecha_resolucion') is-invalid @enderror" name="fecha_resolucion" value="{{ old('fecha_resolucion') }}">
                    <label for="fecha_resolucion">Fecha resolución</label>
                    @error('fecha_resolucion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="fas fa-hourglass-start prefix"></i>
                    <input type="text" id="modalidad" class="form-control @error('modalidad') is-invalid @enderror" name="modalidad" value="{{ old('modalidad') }}">
                    <label for="modalidad">Modalidad</label>
                    @error('modalidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="far fa-calendar-check prefix"></i>
                    <input type="text" id="vigencia" class="form-control @error('vigencia') is-invalid @enderror" name="vigencia" value="{{ old('vigencia') }}">
                    <label for="vigencia">Vigencia</label>
                    @error('vigencia')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-chalkboard-teacher prefix"></i>
                    <input type="number" id="paralelos" class="form-control @error('paralelos') is-invalid @enderror" name="paralelos" value="{{ old('paralelos') }}">
                    <label for="paralelos">Paralelos</label>
                    @error('paralelos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="fas fa-table prefix"></i>
                    <input type="date" id="fecha_aprobacion" class="form-control @error('fecha_aprobacion') is-invalid @enderror" name="fecha_aprobacion" value="{{ old('fecha_aprobacion') }}">
                    <label for="fecha_aprobacion">Fecha de aprobación</label>
                    @error('fecha_aprobacion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-chalkboard prefix"></i>
                    <input type="number" id="capacidad_x_paralelo" class="form-control @error('capacidad_x_paralelo') is-invalid @enderror" name="capacidad_x_paralelo" value="{{ old('capacidad_x_paralelo') }}">
                    <label for="capacidad_x_paralelo">Capacidad por paralelo</label>
                    @error('capacidad_x_paralelo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="foto">Seleciona foto</label>
                    <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                    @error('foto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>

@prepend('scriptsHeader')


@endpush
@push('scriptsFooter')
<script>
    $('#menuMaestrias').addClass('active')
</script>
    
@endprepend
@endsection
