@extends('layouts.app',['title'=>'Listado de inscritos'])
@section('breadcrumbs', Breadcrumbs::render('listadoInscripciones',$cohorte))
@section('headerElements')

    <div class="breadcrumb justify-content-center">
      <a href="{{ route('pdfInscripciones',$cohorte->id) }}" class="breadcrumb-elements-item">
        <i class="fas fa-file-pdf"></i> 
          Descargar PDF
      </a>  
      <a data-toggle="modal" data-target="#centralModalSm" role="button" type="button" class="breadcrumb-elements-item">
            <i class="fas fa-plus"></i>
            Nueva inscripción
        </a>
    </div>
@endsection
@section('content')

<!-- Button trigger modal -->

  
  <!-- Central Modal Small -->
  <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
  
    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-fluid" role="document">
  
  
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100" id="myModalLabel">Listado de registros VALIDADOS <br><strong>Por favor selecione un Postulante</strong></h4><br>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                {!! $regTable->html()->table() !!}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Central Modal Small -->


  <div class="card">
    <div class="card-body">
        <div class="table-responsive">
        {!! $inscTable->html()->table() !!}
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
    {{-- image --}}
    <link rel="stylesheet" href="{{ asset('librarys/lightbox/ekko-lightbox.css') }}">
    <script src="{{ asset('librarys/lightbox/ekko-lightbox.min.js') }}"></script>
@endprepend

@push('scriptsFooter')
    <script>
        $('#menuRealizarInscripciones').addClass('active');
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
       {!! $regTable->html()->scripts() !!} 
       {!! $inscTable->html()->scripts() !!} 

@endpush
@endsection
