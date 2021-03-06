@extends('layouts.app',['title'=>'Inscribir'])
@section('breadcrumbs', Breadcrumbs::render('nuevaInscripcion',$reg))
@section('content')
<div class="card">
    <div class="card-header">
        <h1><strong>INCRIBIR EN:</strong> {{ $reg->cohorte->maestria->nombre }} COHORTE {{ $reg->cohorte->numero }}</h1>
        <h2><strong>POSTULANTE:</strong> {{ $reg->user->apellidos_nombres }}</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-6">

        <form action="{{ route('guardarInscripcion') }}" id="formInscripcion" method="POST">
            @csrf
            <input type="hidden" name="registro" value="{{ $reg->id }}" required>
            
            <div class="card">
                <div class="card-header">
                    <h3>Requisitos para la inscripción</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row" colspan="2">
                                    INFORMACIÓN PERSONAL
                                </th>
                                <td>
                                    @if ($reg->user->verificarAtributosVacios())
                                        <span class="badge badge-pill badge-danger">PORFAVOR, SOLICITE ACTUALIZAR</span>    
                                    @else
                                        <span class="badge badge-pill badge-success">SI</span>
                                    @endif
                                    
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="2">
                                    INFORMACIÓN LABORAL
                                    
                                </th>
                                <td>
                                    @if (!$reg->user->informacionLaboral)
                                        <span class="badge badge-pill badge-danger">PORFAVOR, SOLICITE ACTUALIZAR</span>    
                                    @else
                                    <input type="hidden" name="informacionLaboral" value="{{ $reg->user->informacionLaboral->id }}" required>
                                        <span class="badge badge-pill badge-success">SI</span>
                                    @endif
                                </td>
                            </tr>
                            
                            <tr>
                                <th scope="row" colspan="2">
                                    INFORMACIÓN ACADÉMICA
                                </th>
                                <td>
                                    @if (count($reg->user->informacionAcademicos)<=0)
                                        <span class="badge badge-pill badge-danger">PORFAVOR, SOLICITE INGRESAR</span>    
                                    @else
                                        <span class="badge badge-pill badge-success">SI</span>
                                    @endif
                                </td>
                            </tr>

                            @if (count($reg->user->informacionAcademicos)>0)
                            @php($i=0)
                            <tr>
                                <th colspan="3" class="text-center">Selecione un registro académico:</th>
                            </tr>
                                @foreach ($reg->user->informacionAcademicos as $infoAca)
                                @php($i++)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="info_aca{{ $infoAca->id }}" {{ $i==1?'checked':'' }} {{ old('informacionAcademica')==$infoAca->id?'checked':'' }} name="informacionAcademica" value="{{ $infoAca->id }}" required>
                                            <label class="custom-control-label" for="info_aca{{ $infoAca->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>Institución: </strong> {{ $infoAca->institucion }} <br>
                                        <strong>Nivel: </strong> {{ $infoAca->nivel }} <br>
                                        <strong>Tipo de institucion: </strong> {{ $infoAca->tipo_institucion }} <br>
                                        <strong>Título: </strong> {{ $infoAca->titulo }} <br>
                                        <strong>Especialidad: </strong> {{ $infoAca->especialidad }} <br>
                                        <strong>Duración: </strong> {{ $infoAca->duracion }} años<br>
                                    </td>
                                    <td>
                                        <strong>Fecha de graduación: </strong> {{ $infoAca->fecha_graduacion }} <br>
                                        <strong>Calificación de grado: </strong> {{ $infoAca->calificacion_grado }} <br>
                                        <strong>Pais: </strong> {{ $infoAca->pais }} <br>
                                        <strong>Provincia: </strong> {{ $infoAca->provincia }} <br>
                                        <strong>Cantón: </strong> {{ $infoAca->canton }} <br>
                                    </td>
                                </tr>
                                
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>

                    <div class="md-form">
                        <i class="fas fa-file-alt prefix"></i>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                        <label for="descripcion">Descripción de inscripción</label>
                        @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-primary">Inscribir</button>
                </div>
            </div>
        </form>

    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3><strong>HOJA DE VIDA</strong></h3>
                <a href="{{ route('hojaVidaInscripcion',$reg->id) }}" class="pull-right" target="_blanck">Ver en otra ventana</a>
            </div>
            <div class="card-body">
                
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ route('hojaVidaInscripcion',$reg->id) }}" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3><strong>FORMULARIO DE REGISTRO</strong></h3>
                <a href="{{ route('formularioRegistroInscripcion',$reg->id) }}" class="pull-right" target="_blanck">Ver en otra ventana</a>
            </div>
            <div class="card-body">
                
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ route('formularioRegistroInscripcion',$reg->id) }}" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


@prepend('scriptsHeader')
    
    <script src="{{ asset('librarys/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('librarys/validate/localization/messages_es.min.js') }}"></script>
    {{-- confirm --}}
    <link rel="stylesheet" href="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
    {{-- blockui --}}
    <script src="{{ asset('librarys/jquery.blockUI.js') }}"></script>
@endprepend


@push('scriptsFooter')
    <script>
        $('#menuRealizarInscripciones').addClass('active');

        $("#formInscripcion").validate({
            submitHandler: function(form) {
                $.confirm({
                    title: 'Confirmar inscripción!',
                    content: "Declaro haber leído y revisado la Información relativa de {{ $reg->user->apellidos_nombres }}, para incribir en {{ $reg->cohorte->maestria->nombre }} COHORTE {{ $reg->cohorte->numero }}",
                    theme: 'modern',
                    type:'blue',
                    icon:'fas fa-user-check',
                    closeIcon:true,
                    buttons: {
                        confirmar: {
                            btnClass: 'btn-blue',
                            action: function(){
                                $.blockUI({ message: '<h1>  <i class="fas fa-circle-notch fa-spin"></i> Por favor espera, sólo un momento...</h1>' });
                                form.submit();
                            }
                        },
                        cancelar: {
                            
                            action: function(){

                            }
                        }
                    }
                });
                
            },
            errorElement: "strong",
            errorPlacement: function ( error, element ) {
                error.addClass( "invalid-feedback" );
                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.next( "label" ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
            }
        });

    </script>
@endpush
@endsection
