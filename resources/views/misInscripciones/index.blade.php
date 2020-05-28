@extends('layouts.app',['title'=>'Mis inscripciones'])
@section('breadcrumbs', Breadcrumbs::render('misInscripciones'))
@section('content')

    @if (count($inscripciones)>0)
        <div class="card">
            <div class="card-header">
                Mis inscripciones
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Acción</th>
                            <th scope="col">Maestría</th>
                            <th scope="col">Descripción de la inscripción</th>
                            <th scope="col">Fecha de inscripción</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($inscripciones as $reg)
                          <tr>
                            <th scope="row">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Formulario de inscripción" data-toggle="modal" data-title="Formulario de inscripción en {{ $reg->cohorte->maestria->nombre }} COHORTE {{ $reg->cohorte->numero }}"  data-url="{{ route('misInscripcionesVerFormulario',$reg->id) }}" onclick="verFormulario(this);">
                                        <i class="far fa-address-book"></i>
                                    </button>
                                   
                                </div>
                            </th>
                            <td>
                                {{ $reg->cohorte->maestria->nombre }} COHORTE {{ $reg->cohorte->numero }}
                            </td>
                            <td>
                                {{ $reg->descripcio??'N/A' }}
                            </td>
                           
                            <td>
                                {{ $reg->created_at }}
                                <small>{{ $reg->created_at->diffForHumans() }}</small>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
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
                    <iframe class="embed-responsive-item" id="iframeRegistro" src="" allowfullscreen></iframe>
                </div>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

    @else
        <div class="alert alert-info" role="alert">
            <strong>No tienes inscripciones</strong>
        </div>
    @endif

    @prepend('scriptsHeader')
        
    @endprepend

    @push('scriptsFooter')
        <script>
            $('#misInscripciones').addClass('active')
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });

            function verFormulario(arg){
                $('#centralModalSm').modal('show');
                $('#iframeRegistro').attr('src',$(arg).data('url'));
                
                $('#myModalLabel').html($(arg).data('title'));
            }

            $('#centralModalSm').on('hidden.bs.modal', function (e) {
                $('#iframeRegistro').attr('src',"");
                
                $('#myModalLabel').html('');
            })

        </script>
    @endpush
@endsection
