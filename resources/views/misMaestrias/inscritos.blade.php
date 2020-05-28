@extends('layouts.app',['title'=>'Inscritos'])
@section('breadcrumbs', Breadcrumbs::render('miCohorteInscritos',$cohorte))

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
