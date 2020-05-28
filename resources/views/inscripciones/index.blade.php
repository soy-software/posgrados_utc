@extends('layouts.app',['title'=>'Realizar Inscripción'])
@section('breadcrumbs', Breadcrumbs::render('realizarInscripciones'))
@section('content')

<div class="card">
    <div class="card-header">
        @if (count($maestrias)>0)
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="maestria">Selecione una maestría<i class="text-danger">*</i></label>
    
                    <select class="form-control" id="maestria" onchange="cargarCortes(this);">
                        @foreach ($maestrias as $maestria)
                        <option value="{{ $maestria->id }}">{{ $maestria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cohortes">Selecione una cohorte<i class="text-danger">*</i></label>
                    <select class="form-control" id="cohortes" onchange="cargarRegistro(this);">
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group" id="cargarRegistro">
                </div>
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
                        $.post( "{{ route('obtenerCohortesMaestriaInscripcion') }}", { maestria: id })
                        .done(function( data ) {
                        if((data.length)>0){
                            limpiar();
                            $.each(data, function(i, item) {
                                fila+='<option value="'+item.id+'">'+item.numero+'</option>';
                            });
                            $('#cohortes').append(fila);
                            var cohorte=$("#cohortes option:selected").val();
                            var url='{{ route("listadoInscripciones",":cohorte") }}'.replace(':cohorte',cohorte);
                            $('#cargarRegistro').append('<a href="'+url+'" class="btn btn-primary">LISTADO DE REGISTRO</a>');
                            obtenerRegistros(cohorte);

                        }else{
                            $.notify("Maestría no tiene cohortes", "info");
                           limpiar();
                           
                        }
                        }).always(function(){
                            $.unblockUI();
                        }).fail(function(){
                            limpiar();
                            $.notify("Ocurrio un error al intentar cargar los cohortes, vuelva intentar.!", "error");
                        });
                    }

                    function limpiar(){
                        $('#cohortes').html('');
                        $('#cargarRegistro').html('');
                    }
                  
                    function cargarRegistro(arg){
                        var id=$(arg).val();
                        obtenerRegistros(id);
                    }

                    function obtenerRegistros(cohorte){
                        var url="{{ route('obtenerRegistrosCohorteInscripcion', ':cohorte') }}".replace(':cohorte',cohorte);
                        $( "#cargarRegistroTable" ).load(url);
                    }

                    
                </script>
            @endpush

        {{-- end script --}}

        @else
            <div class="alert alert-primary" role="alert">
                <strong>No existe maestrías</strong>
            </div>
        @endif
    </div>

</div>

<div class="card">
    <div class="card-header">
        Listado de registros VALIDADOS <br>
        <strong>Por favor selecione un Postulante</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="cargarRegistroTable"> </div>
    </div>
    
</div>


@push('scriptsFooter')
<script>
    $('#menuRealizarInscripciones').addClass('active');
</script>
@endpush


@endsection
