@extends('layouts.app',['title'=>'Banco de preguntas'])
@section('breadcrumbs', Breadcrumbs::render('bancoPreguntas',$cohorte))
@section('content')
<div class="card">
    <div class="card-header">
        Banco de preguntas para proceso de Entrevista
    </div>
    <div class="card-body">
        <form action="{{ route('guardarBancoPregunta') }}" method="POST">
            @csrf
            <div class="md-form mb-0">
                <input type="hidden" name="cohorte_nuevo" value="{{ $cohorte->id }}" required>
                <input type="text" id="pregunta_nueva" class="form-control @error('pregunta_nueva') is-invalid @enderror" name="pregunta_nueva" value="{{ old('pregunta_nueva') }}" autofocus required>
                <label for="pregunta_nueva">Nueva pregunta<span class="text-danger">*</span></label>
                 @error('pregunta_nueva')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Guardar</button>
            <p class="text-warning">Si no aparace las preguntas, por favor vuelva a <a href="{{ route('bancoPreguntas',$cohorte->id) }}">recargar la página.</a></p>
        </form>
        @if (count($bancoPreguntas)>0)
        <form action="{{ route('actualizarBancoPregunta') }}" method="POST">
            @csrf
            <input type="hidden" name="cohorte" value="{{ $cohorte->id }}">
        <div class="table-responsive">
        @php($i=0)
        <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th scope="col">Acción</th>
                <th scope="col">Pregunta</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($bancoPreguntas as $bp)
                @php($i++)
                    <tr>
                        <th scope="row">
                            <button type="button" onclick="eliminar(this);" data-url="{{ route('eliminarBancoPregunta',$bp->id) }}" data-msg="{{ $bp->pregunta }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </th>
                        <td>
                            <div class="md-form my-0">
                                <input type="hidden" name="id[{{ $bp->id }}]" value="{{ $bp->id }}" required>
                                <input type="text" id="pregunta{{ $bp->id }}" class="form-control @error('pregunta.'.$bp->id) is-invalid @enderror" name="pregunta[{{ $bp->id }}]" value="{{ old('pregunta.'.$bp->id,$bp->pregunta) }}" required>
                                <label for="pregunta{{ $bp->id }}">Pregunta {{ $i }}<span class="text-danger">*</span></label>
                                 @error('pregunta.'.$bp->id)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </td>
                    </tr>

                    
                @endforeach
              
            </tbody>
          </table>

            
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        @endif
    </div>
</div>

@prepend('scriptsHeader')
    {{-- confirm --}}
    <link rel="stylesheet" href="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
@endprepend
@push('scriptsFooter')
    <script>
        $('#menuMaestrias').addClass('active')
    </script>
@endpush
@endsection
