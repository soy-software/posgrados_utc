<div class="card">
    <div class="card-header">
        Complete información
    </div>
    <div class="card-body">
        <input type="hidden" name="id" id="" value="{{ $user->id }}">
        <div class="form-row">
            <div class="md-form col-md-4">
                <i class="fas fa-user prefix"></i>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>
                <label for="name">{{ __('Name') }}<span class="text-danger">*</span></label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> 
            <div class="md-form col-md-4">
                <i class="fas fa-envelope prefix"></i>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$user->email) }}"  {{ isset($editarEmail)?'disabled':'' }}  required>
                <label for="email">Email<span class="text-danger">*</span> </label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="md-form col-md-4">
                <i class="fas fa-lock prefix"></i>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"  autoComplete="off">
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            
            <div class="form-group col-md-4">
                <label for="tipo_identificacion" class="mb-0">Tipo de identificación</label>
                <select id="tipo_identificacion" class="form-control @error('tipo_identificacion') is-invalid @enderror" name="tipo_identificacion">
                    <option value="Cédula" {{ old('tipo_identificacion',$user->tipo_identificacion)=='Cédula'?'selected':'' }}>Cédula</option>
                    <option value="Ruc persona Natural" {{ old('tipo_identificacion',$user->tipo_identificacion)=='Ruc persona Natural'?'selected':'' }}>Ruc persona Natural</option>
                    <option value="Ruc Sociedad Pública" {{ old('tipo_identificacion',$user->tipo_identificacion)=='Ruc Sociedad Pública'?'selected':'' }}>Ruc Sociedad Pública</option>
                    <option value="Ruc Sociedad Privada" {{ old('tipo_identificacion',$user->tipo_identificacion)=='Ruc Sociedad Privada'?'selected':'' }}>Ruc Sociedad Privada</option>
                    <option value="Pasaporte" {{ old('tipo_identificacion',$user->tipo_identificacion)=='Pasaporte'?'selected':'' }}>Pasaporte</option>
                    
                </select>
                @error('tipo_identificacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="md-form col-md-4">
                <i class="fas fa-id-card prefix"></i>
                <input type="text" class="form-control @error('identificacion') is-invalid @enderror" id="identificacion" name="identificacion" value="{{ old('identificacion',$user->identificacion) }}">
                <label for="identificacion">Identificación</label>
                @error('identificacion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="md-form col-md-4">
                <i class="fas fa-globe-americas prefix"></i>
                <input type="text" class="form-control @error('nacionalidad') is-invalid @enderror" id="nacionalidad" name="nacionalidad" value="{{ old('nacionalidad',$user->nacionalidad) }}">
                <label for="nacionalidad">Nacionalidad</label>
                @error('nacionalidad')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="md-form col-md-3">
                <i class="fas fa-user prefix"></i>
                <input type="text" class="form-control @error('primer_nombre') is-invalid @enderror" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre',$user->primer_nombre) }}">
                <label for="primer_nombre">Primer nombre</label>
                @error('primer_nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="md-form col-md-3">
                <i class="fas fa-user prefix"></i>
                <input type="text" class="form-control @error('segundo_nombre') is-invalid @enderror" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre',$user->segundo_nombre) }}">
                <label for="segundo_nombre">Segundo nombre</label>
                @error('segundo_nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="md-form col-md-3">
                <i class="fas fa-user prefix"></i>
                <input type="text" class="form-control @error('primer_apellido') is-invalid @enderror" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido',$user->primer_apellido) }}">
                <label for="primer_apellido">Primer apellido</label>
                @error('primer_apellido')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="md-form col-md-3">
                <i class="fas fa-user prefix"></i>
                <input type="text" class="form-control @error('segundo_apellido') is-invalid @enderror" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido',$user->segundo_apellido) }}">
                <label for="segundo_apellido">Segundo apellido</label>
                @error('segundo_apellido')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="md-form col-md-3">
                <i class="fas fa-calendar-alt prefix"></i>
                <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento',$user->fecha_nacimiento) }}">
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                @error('fecha_nacimiento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label for="">Sexo</label>
                <div class="form-check">
                    <input class="form-check-input @error('sexo') is-invalid @enderror" type="radio" name="sexo" id="sexo_hombre" value="Masculino" {{ old('sexo',$user->sexo)=='Masculino'?'checked':'checked' }}>
                    <label class="form-check-label" for="sexo_hombre"><i class="fas fa-male"></i> Masculino</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="sexo_mujer" value="Femenino" {{ old('sexo',$user->sexo)=='Femenino'?'checked':'' }}>
                    <label class="form-check-label" for="sexo_mujer"><i class="fas fa-female"></i> Femenino</label>
                </div>
                @error('sexo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            

            <div class="form-group col-md-3">
                <label for="estado_civil" class="mb-0">Estado civil</label>
                <select id="estado_civil" class="form-control @error('estado_civil') is-invalid @enderror" name="estado_civil" required>
                    <option value="Soltero/a" {{ old('estado_civil',$user->estado_civil)=='Soltero/a'?'selected':'' }}>Soltero/a</option>
                    <option value="Casado/a" {{ old('estado_civil',$user->estado_civil)=='Casado/a'?'selected':'' }}>Casado/a</option>
                    <option value="Divorciado/a" {{ old('estado_civil',$user->estado_civil)=='Divorciado/a'?'selected':'' }}>Divorciado/a</option>
                    <option value="Vuido/a" {{ old('estado_civil',$user->estado_civil)=='Vuido/a'?'selected':'' }}>Vuido/a</option>
                    
                </select>
                
                @error('estado_civil')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label for="etnia" class="mb-0">Etnia</label>
                <select id="etnia" class="form-control @error('etnia') is-invalid @enderror" name="etnia" required>
                    
                    <option value="Mestizos" {{ old('etnia',$user->etnia)=='Mestizos'?'selected':'' }}>Mestizos</option>
                    <option value="Blancos" {{ old('etnia',$user->etnia)=='Blancos'?'selected':'' }}>Blancos</option>
                    <option value="Afroecuatorianos" {{ old('etnia',$user->etnia)=='Afroecuatorianos'?'selected':'' }}>Afroecuatorianos</option>
                    <option value="Indígenas" {{ old('etnia',$user->etnia)=='Indígenas'?'selected':'' }}>Indígenas</option>
                    <option value="Montubios" {{ old('etnia',$user->etnia)=='Montubios'?'selected':'' }}>Montubios</option>
                    <option value="otros" {{ old('etnia',$user->etnia)=='otros'?'selected':'' }}>otros</option>
                    
                </select>
                @error('etnia')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="form-row">
            <div class="md-form col-md-4">
                <i class="fas fa-phone-volume prefix"></i>
                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" value="{{ old('telefono',$user->telefono) }}" name="telefono">
                <label for="telefono">Teléfono</label>
                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="md-form col-md-4">
                <i class="fas fa-mobile-alt prefix"></i>
                <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular" value="{{ old('celular',$user->celular) }}" >
                <label for="celular">Celular</label>
                @error('celular')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group col-md-4">
                
                <label for="foto">Seleciona foto</label>
                @if(Storage::exists($user->foto))
                    <a href="{{ Storage::url($user->foto) }}" target="_blank">Ver foto actual</a>
                @endif
                <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                @error('foto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            
            <div class="form-group col-md-3">
                <label for="">Tiene discapacidad</label>
                <div class="form-check">
                    <input class="form-check-input @error('tiene_discapacidad') is-invalid @enderror" type="radio" name="tiene_discapacidad"  id="tiene_discapacidad1" value="SI" {{ old('tiene_discapacidad',$user->tiene_discapacidad)=='SI'?'checked':'' }}>
                    <label class="form-check-label" for="tiene_discapacidad1">SI</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tiene_discapacidad" id="tiene_discapacidad2" value="NO" {{ old('tiene_discapacidad',$user->tiene_discapacidad)=='NO'?'checked':'checked' }}>
                    <label class="form-check-label" for="tiene_discapacidad2">NO</label>
                </div>
                @error('tiene_discapacidad')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    
            </div>
            <div class="md-form col-md-3">
                <i class="fas fa-blind prefix"></i>
                <input type="text" class="form-control @error('porcentaje_discapacidad') is-invalid @enderror" id="porcentaje_discapacidad" name="porcentaje_discapacidad" value="{{ old('porcentaje_discapacidad',$user->porcentaje_discapacidad) }}">
                <label for="porcentaje_discapacidad">Porcentaje de discapacidad</label>
                @error('porcentaje_discapacidad')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="canton">Tiene carnet de conadis</label>
                <div class="form-check">
                    <input class="form-check-input @error('tiene_carnet_conadis') is-invalid @enderror" type="radio" name="tiene_carnet_conadis" id="tiene_carnet_conadis1" value="SI" {{ old('tiene_carnet_conadis',$user->tiene_carnet_conadis)=='SI'?'checked':'' }}>
                    <label class="form-check-label" for="tiene_carnet_conadis1">SI</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tiene_carnet_conadis" id="tiene_carnet_conadis2" value="NO" {{ old('tiene_carnet_conadis',$user->tiene_carnet_conadis)=='NO'?'checked':'checked' }}>
                    <label class="form-check-label" for="tiene_carnet_conadis2">NO</label>
                </div>
                @error('tiene_carnet_conadis')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="md-form col-md-3">
                <i class="fas fa-id-card-alt prefix"></i>
                <input type="text" class="form-control @error('porcentaje_carnet_conadis') is-invalid @enderror" id="porcentaje_carnet_conadis" name="porcentaje_carnet_conadis" value="{{ old('porcentaje_carnet_conadis',$user->porcentaje_carnet_conadis) }}">
                <label for="porcentaje_carnet_conadis">Porcentaje carnet conadis</label>
                @error('porcentaje_carnet_conadis')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if(count($roles)>0)
        <div class="form-group">
            <label for="">Selecionar rol</label>
            @foreach ($roles as $rol)
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="roles[{{ $rol->id }}]"  value="{{ $rol->id }}" {{ $user->hasRole($rol)?'checked':'' }} {{ old('roles.'.$rol->id)==$rol->id ?'checked':'' }} id="rol_{{ $rol->id }}">
                    <label class="custom-control-label" for="rol_{{ $rol->id }}">
                        {{ $rol->name }}
                    </label>
                </div>
            @endforeach
            
        </div>
        @endif
    
        <label for="">Lugar de procedencia (Punto de partida de una persona)</label>
        <input type="hidden" name="lat" id="lat" value="{{ old('lat',$user->lat??'-0.917843977740868') }}">
        <input type="hidden" name="lng" id="lng" value="{{ old('lng',$user->lng??'-78.63280960351561') }}">
        <input type="hidden" name="direccion" id="dir" value="{{ old('dir',$user->direccion??'Ecuador') }}">
        
        <div id="map" class="embed-responsive embed-responsive-16by9"></div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>