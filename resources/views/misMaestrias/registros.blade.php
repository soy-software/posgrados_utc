@extends('layouts.app',['title'=>'Registros'])
@section('breadcrumbs', Breadcrumbs::render('miCohorteRegistros',$cohorte))

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
    {{-- image --}}
    <link rel="stylesheet" href="{{ asset('librarys/lightbox/ekko-lightbox.css') }}">
    <script src="{{ asset('librarys/lightbox/ekko-lightbox.min.js') }}"></script>
@endprepend

@push('scriptsFooter')
    <script>
        $('#menuMisMaestrias').addClass('active')
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
    </script>
     {!! $dataTable->scripts() !!}
@endpush
@endsection
