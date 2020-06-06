@extends('layouts.app',['title'=>'Importar datos de excel'])

@section('breadcrumbs', Breadcrumbs::render('importarDatosExcel'))

@section('content')

<form method="POST" action="{{ route('guargarImportacionDatosExcel') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">

            <p><strong class="text-warning">Advertencia:</strong> El archvio excel debe regirse <strong>extrictamente</strong> al formato presentado a continuación.</p>
            <p class="text-info">La primera fila no se subira</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Identificación</th>
                        <th scope="col">Fecha registro</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Institución</th>
                        <th scope="col">Título</th> 
                        <th scope="col">Valor a pagar</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Email</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Maestría</th>
                        <th scope="col">Procedencia</th>
                        <th scope="col">Cantón</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="exampleFormControlFile1">Selecionar archivo que contenga información de usuarios</label>
                <input type="file" name="archivo" class="form-control-file" id="exampleFormControlFile1" required>
            </div>

        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-primary">Importar usuarios</button>
        </div>
    </div>
</form>

@prepend('scriptsHeader')
    
@endprepend

@push('scriptsFooter')
    <script>
        $('#menuImportarDatosExcel').addClass('active')
    </script>
@endpush
@endsection
