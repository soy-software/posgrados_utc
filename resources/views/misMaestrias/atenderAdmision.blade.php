@extends('layouts.app',['title'=>'Atender entrevista y ensayo'])
@section('breadcrumbs', Breadcrumbs::render('miCohorteAdmisionEntrevistaEnsayo',$admi))
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark">
                Aplicar entrevista
            </div>
            <div class="card-body">
                @if (count($preguntas)>0)
                <form action="{{ route('miCohorteAdmisionEntrevistaActualizar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="admision" value="{{ $admi->id }}" id="" required >
                    <label for="">
                        <span class="badge badge-success">Excelente=3</span>
                        <span class="badge badge-primary">Muy bueno=2</span>
                        <span class="badge badge-warning">Bueno=1.50</span>
                        <span class="badge badge-dark">Regular=1</span>
                        <span class="badge badge-danger">Pobre=0.50</span>
                    </label>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pregunta</th>
                                <th scope="col">Opciones</th>
                                <th scope="col">Resultado</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php($i=0)
                              @foreach ($preguntas as $pre)
                              @php($i++)
                                <tr>
                                    <th scope="row">
                                       {{$i}}
                                    </th>
                                    <td>
                                        <input type="hidden" name="preguntas[{{ $pre->pivot->id }}]" value="{{ $pre->pivot->id }}" required>
                                        {{ $pre->pregunta }}
                                    </td>
                                    <td>
                                        <select class="form-control @error('opcion.'.$pre->pivot->id) is-invalid @enderror" id="" name="opcion[{{ $pre->pivot->id }}]" required >    
                                            <option value="">Selecione una respuesta</option>
                                            <option {{ $pre->pivot->opcion=='Excelente'?'selected':'' }} value="Excelente">Excelente</option>
                                            <option {{ $pre->pivot->opcion=='Muy bueno'?'selected':'' }} value="Muy bueno">Muy bueno</option>
                                            <option {{ $pre->pivot->opcion=='Bueno'?'selected':'' }} value="Bueno">Bueno</option>
                                            <option {{ $pre->pivot->opcion=='Regular'?'selected':'' }} value="Regular">Regular</option>
                                            <option {{ $pre->pivot->opcion=='Pobre'?'selected':'' }} value="Pobre">Pobre</option>
                                        </select>
                                        @error('opcion.'.$pre->pivot->id)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
        
                                    </td>
                                    <td>
                                        {{ $pre->pivot->nota??'Sin contestar' }}
                                    </td>
                                </tr>  
                              @endforeach
                              <tfoot>
                                  <tr>
                                      <td colspan="3">TOTAL</td>
                                      <td><strong>{{ $admi->entrevista }}</strong></td>
                                  </tr>
                              </tfoot>
                                
        
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Actualizar entrevista</button>
                </form>
                @else
                    <div class="alert alert-info" role="alert">
                        <strong>No existe preguntas</strong>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
    <div class="col-md-6">
        <form action="{{ route('miCohorteAdmisionEnsayoActualizar') }}" method="POST">
            @csrf
            <input type="hidden" name="admision" value="{{ $admi->id }}">
            <div class="card">
                <div class="card-header bg-dark">
                    Valorar el documento de Ensayo sobre 2 puntos
                </div>
                <div class="card-body">
                    <div class="md-form ">
                        <i class="fas fa-file-alt prefix"></i>
                        <input type="text" id="nota" name="nota" value="{{ old('nota',$admi->ensayo) }}" class="form-control @error('nota') is-invalid @enderror"  required>
                        <label for="nota">Ingresar nota de ensayo<strong class="text-danger">*</strong></label>
                        @error('nota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>

        <form action="{{ route('miCohorteAdmisionAprobarReprobar') }}" method="POST">
            @csrf
            <input type="hidden" name="admision" id="" value="{{ $admi->id }}">
            <div class="card">
                <div class="card-header bg-dark">
                    Aprobar/Reprobar Admisíon
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="estado">Estado de admisión</label>
                        <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                            <option value="">Selecione</option>
                            <option value="Aprobado" {{ $admi->estado=='Aprobado'?'selected':'' }}>Aprobado</option>
                            <option value="Reprobado" {{ $admi->estado=='Reprobado'?'selected':'' }}>Reprobado</option>
                        </select>
                        @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>


@push('scriptsFooter')
    <script>
        $('#menuMisMaestrias').addClass('active')
    </script>
@endpush
@endsection
