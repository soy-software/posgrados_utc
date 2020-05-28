@extends('layouts.app',['title'=>'Listado de cohortes'])
@section('breadcrumbs', Breadcrumbs::render('cohortes',$maestria))
@section('headerElements')

    <div class="breadcrumb justify-content-center">
        <a href="{{ route('nuevaCohorte',$maestria->id) }}" class="breadcrumb-elements-item">
            <i class="fas fa-plus"></i>
            Nueva cohorte
        </a>
        
    </div>
@endsection

@section('content')

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
