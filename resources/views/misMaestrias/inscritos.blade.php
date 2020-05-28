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

<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">
                
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" id="contenedorFormularioRegistro" src="" allowfullscreen></iframe>
        </div>
        </div>
        <div class="modal-footer">
            
            <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Cerrar</button>
        </div>
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

        function verFormulario(arg){
            $('#centralModalSm').modal('show');
            $('#contenedorFormularioRegistro').attr('src',$(arg).data('url'));
            $('#myModalLabel').html($(arg).data('msg'));
           
            
        }
        $('#centralModalSm').on('hidden.bs.modal', function (e) {
            $('#contenedorFormularioRegistro').attr('src','');
            $('#myModalLabel').html('');
           
        })

    </script>
     {!! $dataTable->scripts() !!}
@endpush
@endsection
