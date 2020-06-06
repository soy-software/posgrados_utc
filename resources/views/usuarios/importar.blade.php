@extends('layouts.app',['title'=>'Importar usuarios'])

@section('breadcrumbs', Breadcrumbs::render('importarUsuario'))

@section('content')

<form method="POST" action="{{ route('guargarImportacionUsuarios') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">

            <p><strong class="text-warning">Advertencia:</strong> El archvio excel debe regirse <strong>extrictamente</strong> al formato presentado a continuación.</p>
            <p class="text-info">La primera fila no se subira</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Nombre de usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Roles <strong>Seporados por una ","</strong></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Pepito</td>
                        <th scope="row">pepito@gmail.com</th>
                        <td>pepito02</td>
                        <td>
                            @if (count($roles)>0)
                                @foreach ($roles as $rol)
                                    {{ $rol->name }},
                                @endforeach
                            @else
                            Administrador,Secretaría, Coordinador, etc
                            @endif
                        </td>
                    </tr>
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
        $('#menuUsuarios').addClass('active')
    </script>
@endpush
@endsection
