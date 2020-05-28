@extends('layouts.app',['title'=>'Roles'])
@section('breadcrumbs', Breadcrumbs::render('roles'))
@section('content')
<div class="card">
    
    <div class="card-body">
        <form method="POST" action="{{ route('guardarRol') }}">
            @csrf

            <div class="md-form ">
                <i class="fas fa-user-tag prefix"></i>
                <input type="text" id="rol" name="rol" value="{{ old('rol') }}" class="form-control @error('rol') is-invalid @enderror"  required>
                <label for="rol">Nuevo rol</label>
                @error('rol')
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
        $('#menuRoles').addClass('active')
    </script>
     {!! $dataTable->scripts() !!}
@endpush
@endsection
