@extends('layouts.app',['title'=>'Editar malla curricular'])
@section('breadcrumbs', Breadcrumbs::render('editarMallaCurricular',$malla))
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Selecione un docente
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table()  !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <form action="{{ route('actualizarMallaCurricular') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $malla->id }}" required>
            <div class="card">
                <div class="card-header">
                    <div class="form-group">
                        <label for="docente">Docente</label>
                        <input type="hidden" id="docente" name="docente" value="{{ old('docente',$malla->docente->id) }}" required>
                        <input type="text" class="form-control" id="docente_msg" value="{{ old('email_docente',$malla->docente->email) }}" readonly>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($materias)>0)
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Selecione una materia</label>
                            <select class="form-control" name="materia" id="exampleFormControlSelect1">
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}" {{ old('materia',$malla->materia->id)==$materia->id?'selected':'' }} >{{ $materia->nombre }}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            <strong>No existe materias</strong>
                        </div>
                    @endif

                    <div class="md-form ">
                        <i class="fas fa-list-ol prefix"></i>
                        <input type="text" id="nivel" name="nivel" value="{{ old('nivel',$malla->nivel) }}" class="form-control @error('nivel') is-invalid @enderror">
                        <label for="nivel">Nivel</label>
                        @error('nivel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="md-form ">
                        <i class="fas fa-th-list prefix"></i>
                        <input type="text" id="categoria" name="categoria" value="{{ old('categoria',$malla->categoria) }}" class="form-control @error('categoria') is-invalid @enderror">
                        <label for="categoria">Categoría</label>
                        @error('categoria')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="md-form ">
                        <i class="far fa-list-alt prefix"></i>
                        <input type="number" id="subindice" name="subindice" value="{{ old('subindice',$malla->subindice) }}" class="form-control @error('subindice') is-invalid @enderror">
                        <label for="subindice">Subíndice</label>
                        @error('subindice')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                    
                </div>
            </div>
        </form>
    </div>
</div>

@prepend('scriptsHeader')
    <link rel="stylesheet" href="{{ asset('librarys/DataTables/datatables.min.css') }}">
    <script src="{{ asset('librarys/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

@endprepend

@push('scriptsFooter')
    <script>
        $('#menuMaestrias').addClass('active')

        function selecionar(arg){
            $('#docente_msg').val($(arg).data('msg'))
            $('#docente').val($(arg).data('id'))
        }
    </script>
     {!! $dataTable->scripts() !!}
@endpush
@endsection
