@extends('layouts.app',['title'=>'Mis registros'])
@section('breadcrumbs', Breadcrumbs::render('misRegistros'))
@section('content')

    @if (count($registros)>0)
        <div class="card">
            <div class="card-header">
                Mis registros
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Acción</th>
                            <th scope="col">Maestría</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Valor de registro</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($registros as $reg)
                          <tr>
                            <th scope="row">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    @can('subirComprobanteRegistro', $reg)
                                    <button type="button" onclick="location.href='{{ route('subirComprobanteRegistro',$reg->id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Subir comprobante de registro">
                                        <i class="fas fa-upload"></i>
                                    </button>
                                    @endcan
                                    <button type="button" class="btn btn-dark" data-toggle="tooltip" data-placement="top" title="Ver formulario de registro" data-toggle="modal" data-title="Formulario de registro en {{ $reg->cohorte->maestria->nombre }} COHORTE {{ $reg->cohorte->numero }}" data-urlver="{{ route('descargarFormularioRegistroPdf',$reg->id) }}" data-url="{{ route('verFormularioRegistroPdf',$reg->id) }}" onclick="verFormulario(this);">
                                        <i class="far fa-address-book"></i>
                                    </button>
                                   
                                </div>
                            </th>
                            <td>
                                {{ $reg->cohorte->maestria->nombre }} COHORTE {{ $reg->cohorte->numero }}
                            </td>
                            <td>
                                {{ $reg->estado }}
                            </td>
                            <td class="text-center">
                                @if (Storage::exists($reg->foto))
                                <a href="{{ Storage::url($reg->foto) }}" class="my-0 mb-0 mt-0" data-toggle="lightbox" data-title="Comprobante de registro" data-footer="{{ $reg->cohorte->maestria->nombre }} COHORTE {{ $reg->cohorte->numero }}">
                                    <img src="{{ Storage::url($reg->foto) }}" class="img-fluid my-0 mb-0 mt-0" width="30px">
                                </a>
                                @else
                                <span class="badge badge-pill badge-info">Sin subir</span>    
                                @endif
                                
                            </td>
                            <td>
                                {{ $reg->cohorte->valor_inscripcion }}
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
                    <a href="" id="descargarRegistro" class="btn btn-primary btn-sm">Descargar</a>
                    <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

    @else
        <div class="alert alert-info" role="alert">
            <strong>No tienes registros</strong>
        </div>
    @endif

    @prepend('scriptsHeader')
        <link rel="stylesheet" href="{{ asset('librarys/lightbox/ekko-lightbox.css') }}">
        <script src="{{ asset('librarys/lightbox/ekko-lightbox.min.js') }}"></script>
    @endprepend

    @push('scriptsFooter')
        <script>
            $('#misRegistros').addClass('active')
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });

            function verFormulario(arg){
                $('#centralModalSm').modal('show');
                $('#iframeRegistro').attr('src',$(arg).data('url'));
                $("#descargarRegistro").attr("href", $(arg).data('urlver'));
                $('#myModalLabel').html($(arg).data('title'));
            }

            $('#centralModalSm').on('hidden.bs.modal', function (e) {
                $('#iframeRegistro').attr('src',"");
                $("#descargarRegistro").attr("href", "");
                $('#myModalLabel').html('');
            })

        </script>
    @endpush
@endsection
