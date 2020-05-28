@extends('layouts.app',['title'=>'Registro'])
@section('breadcrumbs', Breadcrumbs::render('registro'))
@section('content')
@if (Session::has('RegistroOk'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong> {{ Session::get('RegistroOk')['msg'] }}</strong><br>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#centralModalSm">
            Ver formulario
        </button>
        <a href="{{ route('descargarFormularioRegistroPdf',Session::get('RegistroOk')['id']) }}" class="btn btn-primary">
            Descargar formulario
        </a>
    </div>

    <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">
                    {{ Session::get('RegistroOk')['msg'] }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ route('verFormularioRegistroPdf',Session::get('RegistroOk')['id']) }}" allowfullscreen></iframe>
            </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('descargarFormularioRegistroPdf',Session::get('RegistroOk')['id']) }}" class="btn btn-primary btn-sm">Descargar</a>
                <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

    <script>
        $('#centralModalSm').modal('show');
    </script>

@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    @can('registro', App\Models\Cohorte::class)
                    
                    <form method="POST" action="{{ route('guardarRegistro') }}" id="formRegistro">
                        @csrf

                        <div class="form-group">
                            <label for="cohorte">Seleccione una maestría<span class="text-danger">*</span></label>
                            <select class="form-control" id="cohorte" name="cohorte" required>
                              @foreach ($cohortes as $cohorte)
                                <option value="{{ $cohorte->id }}" {{ old('cohorte'==$cohorte->id?'selected':'') }}>{{ $cohorte->maestria->nombre }} - Cohorte {{ $cohorte->numero }}</option>  
                              @endforeach
                                
                            </select>
                        </div>

                        @guest
                         
                            <div class="form-row">
                                <div class="md-form col-md-3">
                                    <i class="fas fa-user prefix"></i>
                                    <input type="text" class="form-control @error('primer_nombre') is-invalid @enderror" id="primer_nombre" name="primer_nombre" value="{{ old('primer_nombre') }}" required autofocus>
                                    <label for="primer_nombre">Primer nombre<span class="text-danger">*</span></label>
                                    @error('primer_nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="md-form col-md-3">
                                    <i class="fas fa-user prefix"></i>
                                    <input type="text" class="form-control @error('segundo_nombre') is-invalid @enderror" id="segundo_nombre" name="segundo_nombre" value="{{ old('segundo_nombre') }}" required>
                                    <label for="segundo_nombre">Segundo nombre<span class="text-danger">*</span></label>
                                    @error('segundo_nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                
                                <div class="md-form col-md-3">
                                    <i class="fas fa-user prefix"></i>
                                    <input type="text" class="form-control @error('primer_apellido') is-invalid @enderror" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" required>
                                    <label for="primer_apellido">Primer apellido<span class="text-danger">*</span></label>
                                    @error('primer_apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="md-form col-md-3">
                                    <i class="fas fa-user prefix"></i>
                                    <input type="text" class="form-control @error('segundo_apellido') is-invalid @enderror" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}" required>
                                    <label for="segundo_apellido">Segundo apellido<span class="text-danger">*</span></label>
                                    @error('segundo_apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="md-form">
                                <i class="fas fa-envelope prefix"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <label for="email">{{ __('E-Mail Address') }}<span class="text-danger">*</span></label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-row">
                                <div class="md-form col-md-6">
                                    <i class="fas fa-lock prefix"></i>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <label for="password">{{ __('Password') }}<span class="text-danger">*</span></label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="md-form col-md-6">
                                    <i class="fas fa-lock prefix"></i>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <label for="password-confirm">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            
                            <div class="form-row">
                
                                <div class="form-group col-md-6">
                                    <label for="tipo_identificacion" class="mb-0">Tipo de identificación<span class="text-danger">*</span></label>
                                    <select id="tipo_identificacion" class="form-control @error('tipo_identificacion') is-invalid @enderror" name="tipo_identificacion" required>
                                        <option value="Cédula" {{ old('tipo_identificacion')=='Cédula'?'selected':'' }}>Cédula</option>
                                        <option value="Ruc persona Natural" {{ old('tipo_identificacion')=='Ruc persona Natural'?'selected':'' }}>Ruc persona Natural</option>
                                        <option value="Ruc Sociedad Pública" {{ old('tipo_identificacion')=='Ruc Sociedad Pública'?'selected':'' }}>Ruc Sociedad Pública</option>
                                        <option value="Ruc Sociedad Privada" {{ old('tipo_identificacion')=='Ruc Sociedad Privada'?'selected':'' }}>Ruc Sociedad Privada</option>
                                        <option value="Pasaporte" {{ old('tipo_identificacion')=='Pasaporte'?'selected':'' }}>Pasaporte</option>
                                        
                                    </select>
                                    @error('tipo_identificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="md-form col-md-6">
                                    <i class="fas fa-id-card prefix"></i>
                                    <input type="text" class="form-control @error('identificacion') is-invalid @enderror" id="identificacion" name="identificacion" value="{{ old('identificacion') }}" required>
                                    <label for="identificacion">Identificación<span class="text-danger">*</span></label>
                                    @error('identificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                
                            </div>
                
                            
                            <div class="form-row">
                                <div class="md-form col-md-6">
                                    <i class="fas fa-phone-volume prefix"></i>
                                    <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono" value="{{ old('telefono') }}" name="telefono">
                                    <label for="telefono">Teléfono</label>
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="md-form col-md-6">
                                    <i class="fas fa-mobile-alt prefix"></i>
                                    <input type="number" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular" value="{{ old('celular') }}"  required>
                                    <label for="celular">Celular<span class="text-danger">*</span></label>
                                    @error('celular')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="md-form col-md-4">
                                    <i class="fas fa-user-graduate prefix"></i>
                                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" value="{{ old('titulo') }}" name="titulo" required>
                                    <label for="titulo">Título de grado. (3er. Nivel)<span class="text-danger">*</span></label>
                                    @error('titulo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="md-form col-md-4">
                                    <i class="fas fa-graduation-cap prefix"></i>
                                    <input type="text" class="form-control @error('especialidad') is-invalid @enderror" id="especialidad" name="especialidad" value="{{ old('especialidad') }}"  required>
                                    <label for="especialidad">Especialidad de grado (3er. Nivel)<span class="text-danger">*</span></label>
                                    @error('especialidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="md-form col-md-4">
                                    <i class="fas fa-university prefix"></i>
                                    <input type="text" class="form-control @error('institucion') is-invalid @enderror" id="institucion" name="institucion" value="{{ old('institucion') }}"  required>
                                    <label for="institucion">Institución donde obtuvo el título de 3er. Nivel<span class="text-danger">*</span></label>
                                    @error('institucion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <label for="">Lugar de procedencia (Punto de partida de una persona)<span class="text-danger">*</span></label>
                            <input type="hidden" name="lat" id="lat" value="{{ old('lat','-0.917843977740868') }}">
                            <input type="hidden" name="lng" id="lng" value="{{ old('lng','-78.63280960351561') }}">
                            <input type="hidden" name="direccion" id="dir" value="{{ old('dir','Ecuador') }}">
                            
                            <div id="map" class="embed-responsive embed-responsive-16by9"></div>
                           
                            
                        @else
                            <p>Registrar como <strong>{{ Auth::user()->email }}</strong></p>
                        @endguest
                        
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>

                    </form>
                    @else
                    <div class="alert alert-info" role="alert">
                        <strong>No existe maestrías para el registro</strong>
                    </div>
                    @endcan
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
    @guest

    <script src="{{ asset('js/mapaUser.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bcJ39miYRDXIr4ux3484nqQP1XqS9Bw&callback=initMap" async defer></script>

    @endguest

    <script>
        $("#formRegistro").validate({
            rules:{
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation:{
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }
            },
            submitHandler: function(form) {
                $.confirm({
                    title: 'Confirmar registro!',
                    content: "Declaro haber leído y aceptado la Información relativa la tratamiento de datos para ser contactado por {{ config('app.name') }}",
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
        $('#menuRegistrar').addClass('active');
    </script>
    
@endprepend

@endsection
