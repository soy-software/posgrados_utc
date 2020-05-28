@extends('layouts.app',['title'=>'Subir comprobante de matrícula'])
{{-- @section('breadcrumbs', Breadcrumbs::render('subirComprobanteRegistro',$registro)) --}}
@section('content')
<div class="card">
    <div class="card-header">
        Subir comprobante de matrícula
    </div>
    <div class="card-body">
        <div class="file-loading">
            <input id="input-700" name="foto" type="file" accept="image/*" >
        </div>
         
    </div>
</div>
@prepend('scriptsHeader')

    <link href="{{ asset('librarys/kartik-v-bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('librarys/kartik-v-bootstrap-fileinput/themes/explorer-fas/theme.min.css') }}" media="all" rel="stylesheet" type="text/css"/>
    
    <script src="{{ asset('librarys/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('librarys/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('librarys/kartik-v-bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('librarys/kartik-v-bootstrap-fileinput/js/locales/es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('librarys/kartik-v-bootstrap-fileinput/themes/fas/theme.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('librarys/kartik-v-bootstrap-fileinput/themes/explorer-fas/theme.min.js') }}" type="text/javascript"></script>
    <script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>
@endprepend

@push('scriptsFooter')
    <script>
        $('#misAdmisiones').addClass('active')
        
        $("#input-700").fileinput({
           
            autoReplace: true,
            overwriteInitial: true,
            maxFileCount: 1,
            initialPreview: [
                "<img class='kv-preview-data file-preview-image' src='{{ Storage::url($admision->comprobante) }}'>"
            ],
            initialCaption: 'Comprobante de matrícula',
            initialPreviewShowDelete: false,
            showRemove: false,
            showClose: false,
            layoutTemplates: {actionDelete: ''}, // disable thumbnail deletion
            allowedFileExtensions: ["jpg", "jpeg", "png"],
            theme:"fas",
            language:"es",
            uploadUrl: "{{ route('guardarComprobanteParaMatricula') }}",
            uploadExtraData: {
                admision:"{{ $admision->id }}",
            }
        }).on('fileuploaded', function(event, previewId, index, fileId) {
            $.notify("Comprobante de matrícula actualizado exitosamente", "success");
        }).on('fileuploaderror', function(event, previewId, index, fileId) {
            $.notify("Ocurrio un error, porfavor vuelva intentar", "error");
        }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
            
        });

    </script>
@endpush
@endsection
