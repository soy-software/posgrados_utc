@extends('layouts.app',['title'=>'Admisión'])
@section('breadcrumbs', Breadcrumbs::render('admision',$cohorte))
@section('content')

@if (count($inscritos)>0)
<form action="{{ route('actualizarExamenAdmision') }}" id="formExamen" method="POST">
    @csrf
    <input type="hidden" name="cohorte" value="{{ $cohorte->id }}" required>
    <div class="card">
        <div class="card-header">
            Listado de inscritos
        </div>
        <div class="card-body">
            <div class="table-responsive table-sm">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Identificación</th>
                        <th scope="col">Postulante</th>
                        <th scope="col">Email</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Examén</th>
                        <th scope="col">Entrevista</th>
                        <th scope="col">Ensayo</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($inscritos as $ins)
                        <tr>
                            <th scope="row">
                                {{ $ins->user->identificacion }}
                            </th>
                            <td>
                                {{ $ins->user->apellidos_nombres }}
                            </td>
                            <td>
                                {{ $ins->user->email }}
                            </td>
                            <td>{{ $ins->admision->estado??'' }}</td>
                            <td>
                                
                                <div class="md-form md-outline my-0">
                                    <input type="hidden" name="inscripcion[{{ $ins->id }}]" value="{{ $ins->id }}" required>
                                    <input type="text" name="nota[{{ $ins->id }}]" id="nota{{ $ins->id }}" value="{{ old('nota.'.$ins->id,$ins->admision->examen??'0.00') }}" class="form-control @error('nota.'.$ins->id) is-invalid @enderror" >
                                    <label for="nota{{ $ins->id }}">Ingrese nota</label>
                                    @error('nota.'.$ins->id)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                {{ $ins->admision->entrevista??'0.00' }}
                            </td>
                            <td>
                                {{ $ins->admision->ensayo??'0.00' }}
                            </td>
                            <td>
                                @php($ex=$ins->admision->examen??'0.00')
                                @php($en=$ins->admision->entrevista??'0.00')
                                @php($ens=$ins->admision->ensayo??'0.00')
                                
                                {{ number_format($ex+$en+$ens,2) }}
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <button class="btn btn-primary" type="submit">Actualizar nota de examén</button>
        </div>
    </div>
</form>
@else
    <div class="alert alert-info" role="alert">
        <strong>No existe inscritos en esta cohorte</strong>
    </div>
@endif

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
        $('#menuMaestrias').addClass('active');
        $("#formExamen").validate({
            submitHandler: function(form) {
                $.confirm({
                    title: 'Confirmar actualización de notas de examenes!',
                    content: "Declaro haber proporcionado información relativa",
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
