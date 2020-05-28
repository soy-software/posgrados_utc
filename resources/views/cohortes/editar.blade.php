@extends('layouts.app',['title'=>'Nueva maestría'])
@section('breadcrumbs', Breadcrumbs::render('editarCohorte',$cohorte))
@section('content')

<form action="{{ route('actualizarCohorte') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            Complete información
        </div>
        <div class="card-body">
            
          <input type="hidden" name="id" value="{{ $cohorte->id }}" required>
            <div class="form-row">
                <div class="md-form col-md-6">
                    <i class="fas fa-sort-numeric-down-alt prefix"></i>
                    <input type="number" id="numero" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero',$cohorte->numero) }}" required autofocus>
                    <label for="numero">Número<span class="text-danger">*</span></label>
                    @error('numero')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-6">
                    <i class="fas fa-house-damage prefix"></i>
                    <input type="text" id="sede" class="form-control @error('sede') is-invalid @enderror" name="sede" value="{{ old('sede',$cohorte->sede) }}" required>
                    <label for="sede">Sede<span class="text-danger">*</span></label>
                    @error('sede')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="md-form col-md-6">
                    <i class="fas fa-calendar-day prefix"></i>
                    <input type="text" id="modalidad" class="form-control @error('modalidad') is-invalid @enderror" name="modalidad" value="{{ old('modalidad',$cohorte->modalidad) }}" required>
                    <label for="modalidad">Modalidad<span class="text-danger">*</span></label>
                    @error('modalidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-6">
                    <i class="fas fa-door-open prefix"></i>
                    <input type="text" id="paralelos" class="form-control @error('paralelos') is-invalid @enderror" name="paralelos" value="{{ old('paralelos',$cohorte->paralelo) }}" required>
                    <label for="paralelos">Paralelos<span class="text-danger">*</span></label>
                    @error('paralelos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="fas fa-dollar-sign prefix"></i>
                    <input type="number" id="valor_inscripcion" class="form-control @error('valor_inscripcion') is-invalid @enderror" name="valor_inscripcion" value="{{ old('valor_inscripcion',$cohorte->valor_inscripcion) }}" required>
                    <label for="valor_inscripcion">Valor de la inscripción<span class="text-danger">*</span></label>
                    @error('valor_inscripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-dollar-sign prefix"></i>
                    <input type="number" id="valor_matricula" class="form-control @error('valor_matricula') is-invalid @enderror" name="valor_matricula" value="{{ old('valor_matricula',$cohorte->valor_matricula) }}" required>
                    <label for="valor_matricula">Valor de la matricula<span class="text-danger">*</span></label>
                    @error('valor_matricula')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form col-md-4">
                    <i class="fas fa-dollar-sign prefix"></i>
                    <input type="number" id="valor_colegiatura" class="form-control @error('valor_colegiatura') is-invalid @enderror" name="valor_colegiatura" value="{{ old('valor_colegiatura',$cohorte->valor_colegiatura) }}" required>
                    <label for="valor_colegiatura">Valor de la colegiatura<span class="text-danger">*</span></label>
                    @error('valor_colegiatura')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="exampleFormControlSelect1">Estado</label>
                <select class="form-control" id="exampleFormControlSelect1" name="estado" required>
                    <option value="Procedimiento de difusión" {{ old('estado',$cohorte->estado)=='Procedimiento de difusión'?'selected':'' }}>Procedimiento de difusión</option>
                    <option value="Postulación e inscripción" {{ old('estado',$cohorte->estado)=='Postulación e inscripción'?'selected':'' }}>Postulación e inscripción</option>
                    <option value="Admisión y matricula" {{ old('estado',$cohorte->estado)=='Admisión y matricula'?'selected':'' }}>Admisión y matricula</option>
                    <option value="Desarrollo académico" {{ old('estado',$cohorte->estado)=='Desarrollo académico'?'selected':'' }}>Desarrollo académico</option>
                    <option value="Finalizado" {{ old('estado',$cohorte->estado)=='Finalizado'?'selected':'' }}>Finalizado</option>
                </select>
              </div>

            @if (count($coordinadores)>0)
                <div class="form-group">
                    <label for="">Selecionar coordinadores</label>
                    @foreach ($coordinadores as $coordinador)
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="coordinadores[{{ $coordinador->id }}]"  value="{{ $coordinador->id }}" {{ $cohorte->hasCoordinador($cohorte->id,$coordinador->id)?'checked':'' }} {{ old('coordinadores.'.$coordinador->id)==$coordinador->id ?'checked':'' }} id="coordinador_{{ $coordinador->id }}">
                            <label class="custom-control-label" for="coordinador_{{ $coordinador->id }}">
                                {{ $coordinador->primer_apellido }} {{ $coordinador->segundo_apellido }} {{ $coordinador->primer_nombre }} {{ $coordinador->segundo_nombre }}
                                <small>{{ $coordinador->email }}</small>
                            </label>
                        </div>
                    @endforeach
                    
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <strong>No existe usuarios con rol coordinador</strong>
                </div>
            @endif


            

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
