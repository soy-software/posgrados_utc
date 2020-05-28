@extends('layouts.app',['title'=>'Información laboral'])
@section('breadcrumbs', Breadcrumbs::render('miPerfilInfoLaboral'))
@section('content')

<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

    @include('usuarios.perfil.menu',['user'=>$user])
  
    <!-- Right content -->
    <div class="tab-content w-100">
      <div class="tab-pane fade active show">
        <form action="{{ route('actualizarMiPerfilInfoLaboral') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    Complete información
                </div>
                <div class="card-body">
                    
                   
            
                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label for="trabaja" class="mb-0">Trabaja</label>
                            <select id="trabaja" class="form-control @error('trabaja') is-invalid @enderror" name="trabaja">
                                <option value="NO" {{ old('trabaja',$info->trabaja??'')=='NO'?'selected':'' }}>NO</option>
                                <option value="SI" {{ old('trabaja',$info->trabaja??'')=='SI'?'selected':'' }}>SI</option>
                            </select>
                            @error('trabaja')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tipo_institucion" class="mb-0">Tipo de institución</label>
                            <select id="tipo_institucion" class="form-control @error('tipo_institucion') is-invalid @enderror" name="tipo_institucion">
                                <option value="PÚBLICA" {{ old('tipo_institucion',$info->tipo_institucion??'')=='PÚBLICA'?'selected':'' }}>PÚBLICA</option>
                                <option value="PRIVADA" {{ old('tipo_institucion',$info->tipo_institucion??'')=='PRIVADA'?'selected':'' }}>PRIVADA</option>
                                <option value="MIXTA" {{ old('tipo_institucion',$info->tipo_institucion??'')=='MIXTA'?'selected':'' }}>MIXTA</option>
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
                            <i class="fas fa-university prefix"></i>
                            <input type="text" class="form-control @error('empresa') is-invalid @enderror" id="empresa" name="empresa" value="{{ old('empresa',$info->empresa??'') }}">
                            <label for="empresa">Empresa</label>
                            @error('empresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-6">
                            <i class="fas fa-briefcase prefix"></i>
                            <input type="text" class="form-control @error('cargo') is-invalid @enderror" id="cargo" name="cargo" value="{{ old('cargo',$info->cargo??'') }}">
                            <label for="cargo">Cargo</label>
                            @error('cargo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="md-form col-md-4">
                            <i class="fas fa-globe-americas prefix"></i>
                            <input type="text" class="form-control @error('pais') is-invalid @enderror" id="pais" name="pais" value="{{ old('pais',$info->pais??'') }}">
                            <label for="pais">País</label>
                            @error('pais')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-4">
                            <i class="fas fa-flag-usa prefix"></i>
                            <input type="text" class="form-control @error('provincia') is-invalid @enderror" id="provincia" name="provincia" value="{{ old('provincia',$info->provincia??'') }}">
                            <label for="provincia">Provincia</label>
                            @error('provincia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-4">
                            <i class="fas fa-flag prefix"></i>
                            <input type="text" class="form-control @error('canton') is-invalid @enderror" id="canton" name="canton" value="{{ old('canton',$info->canton??'') }}">
                            <label for="canton">Cantón</label>
                            @error('canton')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="md-form col-md-4">
                            <i class="fas fa-phone-volume prefix"></i>
                            <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono',$info->telefono??'') }}">
                            <label for="telefono">Teléfono</label>
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-4">
                            <i class="fas fa-blender-phone prefix"></i>
                            <input type="text" class="form-control @error('extencion') is-invalid @enderror" id="extencion" name="extencion" value="{{ old('extencion',$info->extencion??'') }}">
                            <label for="extencion">Extención</label>
                            @error('extencion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="md-form col-md-4">
                            <i class="fas fa-envelope prefix"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$info->email??'') }}">
                            <label for="email">Email</label>
                            @error('email')
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
        $('#menuInformacionLaboral').addClass('active')
    </script>
@endpush
@endsection
