@extends('layouts.app',['title'=>'Mis admisiones'])
@section('breadcrumbs', Breadcrumbs::render('misInscripciones'))
@section('content')

    @if (count($admisiones)>0)
        <div class="card">
            <div class="card-header">
                Mis admisiones
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Acción</th>
                            <th scope="col">Maestría</th>
                            <th scope="col">Estado de admisión</th>
                            <th scope="col">Valor a cancelar matrícula</th>
                            <th scope="col">Estado de factura</th>
                            <th scope="col">Número de factura</th>
                            <th scope="col">Comprobante</th>
                            <th scope="col">Fecha de admisíon</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($admisiones as $admi)
                          <tr>
                            <th scope="row">
                                

                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

                                    
                                    @can('subirComprobanteParaMatricula', $admi)

                                        <button type="button" onclick="location.href='{{ route('subirComprobanteParaMatricula',$admi->id) }}'" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Subir comprobante para matrícula">
                                            <i class="fas fa-upload"></i>
                                        </button>

                                    @endcan


                                </div>

                            <td>
                                {{ $admi->cohorte->maestria->nombre }} COHORTE {{ $admi->cohorte->numero }}
                            </td>
                           
                            <td>
                                <span class="badge badge-pill badge-{{ $admi->estado=='Aprobado'?'success':'danger' }}">{{ $admi->estado }}</span>
                            </td>
                            <td>
                                {{ $admi->valor_factura }}
                            </td>
                            <td>
                                <span class="badge badge-pill badge-{{ $admi->estado_factura=='Aprobado'?'success':'danger' }}">{{ $admi->estado_factura }}</span>
                                
                            </td>
                            
                            <td>
                                {{ $admi->factura }}
                            </td>
                            <td>
                                @if (Storage::exists($admi->comprobante))
                                    ok
                                @else
                                    <span class="badge badge-pill badge-info">Sin subir comprobante</span>
                                @endif
                            </td>
                            <td>
                                {{ $admi->created_at }}
                                <small>{{ $admi->created_at->diffForHumans() }}</small>
                                
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
            <strong>No tienes registros</strong>
        </div>
    @endif

    @prepend('scriptsHeader')
        
    @endprepend

    @push('scriptsFooter')
        <script>
            $('#misAdmisiones').addClass('active')
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
