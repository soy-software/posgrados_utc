@extends('layouts.app',['title'=>'Materías'])
@section('breadcrumbs', Breadcrumbs::render('materias',$maestria))
@section('content')
<div class="card">
    
    <div class="card-body">
        <form method="POST" action="{{ route('guardarMateria') }}">
            @csrf
            <input type="hidden" name="maestria" value="{{ $maestria->id }}">
            <div class="md-form ">
                <i class="far fa-address-book prefix"></i>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror"  required>
                <label for="nombre">Nueva matería<strong class="text-danger">*</strong></label>
                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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
