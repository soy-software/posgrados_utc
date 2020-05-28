@extends('layouts.app',['title'=>'Permisos'])
@section('breadcrumbs', Breadcrumbs::render('permisos',$rol))
@section('content')

<form action="{{ route('sincronizarPermiso') }}" method="post">
    @csrf
    <input type="hidden" name="rol" value="{{ $rol->id }}" required>
    <div class="card">
        <div class="card-header">
            Actualizar permisos
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Asignado</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach ($permisos as $per)
                        <tr>
                            <th scope="row">{{ $per->name }}</th>
                            <td>
                                <input name="permisos[]" value="{{ $per->id }}" type="checkbox" {{ $rol->hasPermissionTo($per) ?'checked':'' }}  data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                            </td>
                        </tr>
    
                        @endforeach
    
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            @can('sincronizar', $rol)
                <button class="btn btn-primary">Actualizar permisos</button>
            @else
            <div class="alert alert-info" role="alert">
                <strong>No se puede actualizar los permisos en rol {{ $rol->name }}</strong>
            </div>
            @endcan
            
        </div>
    </div>
</form>



@push('scriptsFooter')
    <script>
        $('#menuRoles').addClass('active')
    </script>
@endpush

@endsection
