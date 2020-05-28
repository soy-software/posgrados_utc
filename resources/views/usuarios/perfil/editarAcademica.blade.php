@extends('layouts.app',['title'=>'Editar información académica'])
@section('breadcrumbs', Breadcrumbs::render('editarInfoAcademica',$info))
@section('content')

<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

    @include('usuarios.perfil.menu',['user'=>$user])
  
    <!-- Right content -->
    <div class="tab-content w-100">
      <div class="tab-pane fade active show">
        <form action="{{ route('actualizarMiPerfilInfoAcademica') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $info->id }}">
            <div class="card">
                <div class="card-header">
                    Complete información
                </div>
                <div class="card-body">
                    
                    <div class="md-form">
                        <i class="fas fa-university prefix"></i>
                        <input type="text" class="form-control @error('institucion') is-invalid @enderror" id="institucion" name="institucion" value="{{ old('institucion',$info->institucion) }}" required autofocus>
                        <label for="institucion">Institución<strong class="text-danger">*</strong></label>
                        @error('institucion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label for="nivel" class="mb-0">Nivel<strong class="text-danger">*</strong></label>
                            <select id="nivel" class="form-control @error('nivel') is-invalid @enderror" name="nivel" required>
                                <option value="TÉCNOLOGICO SUPERIOR" {{ old('nivel',$info->nivel)=='TÉCNOLOGICO SUPERIOR'?'selected':'' }}>TÉCNOLOGICO SUPERIOR</option>
                                <option value="LICENCIATURA" {{ old('nivel',$info->nivel)=='LICENCIATURA'?'selected':'' }}>LICENCIATURA</option>
                                <option value="TERCER NIVEL" {{ old('nivel',$info->nivel)=='TERCER NIVEL'?'selected':'' }}>TERCER NIVEL</option>
                                <option value="CUARTO NIVEL" {{ old('nivel',$info->nivel)=='CUARTO NIVEL'?'selected':'' }}>CUARTO NIVEL</option>
                                <option value="DOCTORADO" {{ old('nivel',$info->nivel)=='DOCTORADO'?'selected':'' }}>DOCTORADO</option>
                            </select>
                            @error('nivel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tipo_institucion" class="mb-0">Tipo de institución<strong class="text-danger">*</strong></label>
                            <select id="tipo_institucion" class="form-control @error('tipo_institucion') is-invalid @enderror" name="tipo_institucion" required>
                                <option value="PÚBLICA" {{ old('tipo_institucion',$info->tipo_institucion)=='PÚBLICA'?'selected':'' }}>PÚBLICA</option>
                                <option value="PRIVADA" {{ old('tipo_institucion',$info->tipo_institucion)=='PRIVADA'?'selected':'' }}>PRIVADA</option>
                                <option value="MIXTA" {{ old('tipo_institucion',$info->tipo_institucion)=='MIXTA'?'selected':'' }}>MIXTA</option>
                            </select>
                            @error('tipo_institucion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            
                    </div>


                    <div class="form-row">
                        <div class="md-form col-md-6">
                            <i class="fas fa-user-graduate prefix"></i>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo',$info->titulo) }}" required>
                            <label for="titulo">Título<strong class="text-danger">*</strong></label>
                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-6">
                            <i class="fas fa-graduation-cap prefix"></i>
                            <input type="text" class="form-control @error('especialidad') is-invalid @enderror" id="especialidad" name="especialidad" value="{{ old('especialidad',$info->especialidad) }}" required>
                            <label for="especialidad">Especialidad<strong class="text-danger">*</strong></label>
                            @error('especialidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="form-row">
                        <div class="md-form col-md-4">
                            <i class="fas fa-clock prefix"></i>
                            <input type="number" class="form-control @error('duracion') is-invalid @enderror" id="duracion" name="duracion" value="{{ old('duracion',$info->duracion) }}" required>
                            <label for="duracion">Duración (años)<strong class="text-danger">*</strong></label>
                            @error('duracion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-4">
                            <i class="fas fa-calendar-alt prefix"></i>
                            <input type="date" class="form-control @error('fecha_graduacion') is-invalid @enderror" id="fecha_graduacion" name="fecha_graduacion" value="{{ old('fecha_graduacion',$info->fecha_graduacion) }}" required>
                            <label for="fecha_graduacion">Fecha de graduación<strong class="text-danger">*</strong></label>
                            @error('fecha_graduacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-4">
                            <i class="fas fa-sort-numeric-down-alt prefix"></i>
                            <input type="text" class="form-control @error('calificacion_grado') is-invalid @enderror" id="calificacion_grado" name="calificacion_grado" value="{{ old('calificacion_grado',$info->calificacion_grado) }}" required>
                            <label for="calificacion_grado">Calificación de grado<strong class="text-danger">*</strong></label>
                            @error('calificacion_grado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="md-form col-md-4">
                            <i class="fas fa-globe-americas prefix"></i>
                            <input type="text" class="form-control @error('pais') is-invalid @enderror" id="pais" name="pais" value="{{ old('pais',$info->pais) }}" required>
                            <label for="pais">País<strong class="text-danger">*</strong></label>
                            @error('pais')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-4">
                            <i class="fas fa-flag-usa prefix"></i>
                            <input type="text" class="form-control @error('provincia') is-invalid @enderror" id="provincia" name="provincia" value="{{ old('provincia',$info->provincia) }}" required>
                            <label for="provincia">Provincia<strong class="text-danger">*</strong></label>
                            @error('provincia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-4">
                            <i class="fas fa-flag prefix"></i>
                            <input type="text" class="form-control @error('canton') is-invalid @enderror" id="canton" name="canton" value="{{ old('canton',$info->canton) }}" required>
                            <label for="canton">Cantón<strong class="text-danger">*</strong></label>
                            @error('canton')
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
        
      </div>
    </div>
    <!-- /right content -->
  </div>
  <!-- /inner container -->



@push('scriptsFooter')
    <script>
        $('#menuInformacionAcademica').addClass('active')
    </script>
@endpush
@endsection
