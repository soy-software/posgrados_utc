@extends('layouts.app',['title'=>'Paralelos'])
@section('breadcrumbs', Breadcrumbs::render('paralelos',$cohorte))
@section('content')
<div class="card">
    
    <div class="card-body">
        <form method="POST" action="{{ route('guardarParalelo') }}">
            @csrf
            <input type="hidden" name="cohorte" value="{{ $cohorte->id }}">

            <div class="form-row">
                <div class="md-form col-md-4">
                    <i class="fas fa-door-open prefix"></i>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror"  required>
                    <label for="nombre">Nombre de paralelo<strong class="text-danger">*</strong></label>
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            

                <div class="md-form col-md-4">
                    <i class="fas fa-calendar-alt prefix"></i>
                    <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" class="form-control @error('fecha_inicio') is-invalid @enderror">
                    <label for="fecha_inicio">Fecha de inicio</label>
                    @error('fecha_inicio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="md-form col-md-4">
                    <i class="fas fa-calendar-alt prefix"></i>
                    <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" class="form-control @error('fecha_fin') is-invalid @enderror">
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
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            {!! $dataTable->table()  !!}
        </div>
    </div>
</div>

@prepend('scriptsHeader')
    <link rel="stylesheet" href="{{ asset('librarys/DataTables/datatables.min.css') }}">
    <script src="{{ asset('librarys/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{-- confirm --}}
    <link rel="stylesheet" href="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
@endprepend

@push('scriptsFooter')
    <script>
        $('#menuMaestrias').addClass('active')
    </script>
     {!! $dataTable->scripts() !!}
@endpush
@endsection
