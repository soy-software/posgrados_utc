@extends('layouts.app',['title'=>'Inicio'])
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')

<div class="card">
    <div class="card-header">
        @if (count($maestrias)>0)
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="maestria">Selecione una maestría<i class="text-danger">*</i></label>

                <select class="form-control" id="maestria" onchange="cargarCortes(this);">
                    @foreach ($maestrias as $maestria)
                    <option value="{{ $maestria->id }}">{{ $maestria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="cohortes">Selecione una cohorte<i class="text-danger">*</i></label>
                <select class="form-control" id="cohortes" onchange="cargarRegistro(this);">
                </select>
            </div>
        </div>

        {{-- script --}}
            @prepend('scriptsHeader')
                <script>
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                </script>

                {{-- datatables --}}
                <link rel="stylesheet" href="{{ asset('librarys/DataTables/datatables.min.css') }}">
                <script src="{{ asset('librarys/DataTables/datatables.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

                {{-- confirm --}}
                <link rel="stylesheet" href="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.css') }}">
                <script src="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
                {{-- blockui --}}
                <script src="{{ asset('librarys/jquery.blockUI.js') }}"></script>
                {{-- image --}}
                <link rel="stylesheet" href="{{ asset('librarys/lightbox/ekko-lightbox.css') }}">
                <script src="{{ asset('librarys/lightbox/ekko-lightbox.min.js') }}"></script>
            @endprepend

            @push('scriptsFooter')
                <script>
                

                    obtenerCohortes($("#maestria option:selected").val());

                    function cargarCortes(arg){
                        var id=$(arg).val();
                        obtenerCohortes(id)
                    }

                    function obtenerCohortes(id){
                        var fila;
                        $.blockUI({message:'<h1>Espere por favor.!</h1>'});
                        $.post( "{{ route('obtenerCohortesMaestriaValidarRegistro') }}", { maestria: id })
                        .done(function( data ) {
                        if((data.length)>0){
                            $('#cohortes').html('');
                            $.each(data, function(i, item) {
                                fila+='<option value="'+item.id+'">'+item.numero+'</option>';
                            });
                            $('#cohortes').append(fila);
                            var cohorte=$("#cohortes option:selected").val();
                            obtenerRegistros(cohorte);
                        }else{
                            $.notify("Maestría no tiene cohortes", "info");
                            $('#cohortes').html('');
                            $('#cargarRegistro').html('')
                        }
                        }).always(function(){
                            $.unblockUI();
                        }).fail(function(){
                            $('#cohortes').html('');
                            $('#cargarRegistro').html('')
                            $.notify("Ocurrio un error al intentar cargar los cohortes, vuelva intentar.!", "error");
                        });
                    }

                    function cargarRegistro(arg){
                        var id=$(arg).val();
                        obtenerRegistros(id);
                    }

                    function obtenerRegistros(cohorte){
                        $( "#cargarRegistro" ).load('{{ route("obtenerRegistroPorCohorteValidarRegistro", ":cohorte") }}'.replace(':cohorte', cohorte));
                    }


                    function validar(arg){
                        $.confirm({
                            title: 'Validar registro',
                            theme: 'modern',
                            type:'blue',
                            icon:'fas fa-clipboard-check',
                            closeIcon:true,
                            content: '' +
                            '<form action="" class="formName">' +
                            '<div class="form-group">' +
                            '<label>Ingrese número de factura</label>' +
                            '<input type="text" placeholder="Número de factura" id="txtfactura" class="name form-control" value="'+$(arg).data('factura')+'" />' +
                            '<small class="">Al no ingresar # de factura, el Registro vuelva a Sin Validar</small>' +
                            '</div>'+
                            '</form>',
                            buttons: {
                                formSubmit: {
                                    text: 'Guardar',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                        var name = this.$content.find('#txtfactura').val();
                                        enviarFactura($(arg).data('id'),name);
                                    }
                                },
                                cancelar: function () {
                                    //close
                                },
                            },
                            onContentReady: function () {
                                // bind to events
                                var jc = this;
                                this.$content.find('form').on('submit', function (e) {
                                    // if the user submits the form by pressing enter in the field.
                                    e.preventDefault();
                                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                                });
                            }
                        });
                    }


                    function enviarFactura(reg,factura){
                        $.blockUI({ message: '<h1>  <i class="fas fa-circle-notch fa-spin"></i> Por favor espera, sólo un momento...</h1>' });
                        $.post( "{{ route('guardarValidarRegistro') }}", { registro: reg,factura:factura })
                        .done(function( data ) {
                            if(data.success){
                                $('#tesoreria-registro-table').DataTable().ajax.reload(); 
                                $.notify(data.success, "success");
                            }
                            if(data.info){
                                $.notify(data.info, "info");
                            }
                        }).always(function(){
                            $.unblockUI();
                        }).fail(function(){
                            $.notify("Ocurrio un error, porfavor vuelva intentar.!", "error");
                        });
                    }

                    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                        event.preventDefault();
                        $(this).ekkoLightbox();
                    });
                    
                </script>
            @endpush

        {{-- end script --}}

        @else
            <div class="alert alert-primary" role="alert">
                <strong>No existe maestrías</strong>
            </div>
        @endif
    </div>
    <div class="card-body">

        <div class="table-responsive" id="cargarRegistro">

        </div>
            
    </div>
    
</div>


@push('scriptsFooter')
<script>
    
    $('#menuValidarRegistro').addClass('active');
</script>
@endpush


@endsection
