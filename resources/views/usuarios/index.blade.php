@extends('layouts.app',['title'=>'Usuarios'])
@section('breadcrumbs', Breadcrumbs::render('usuarios'))
@section('headerElements')

    <div class="breadcrumb justify-content-center">
        <a href="{{ route('nuevoUsuario') }}" class="breadcrumb-elements-item">
            <i class="fas fa-plus"></i>
            Nuevo usuario
        </a>
        <a href="{{ route('importarUsuario') }}" class="breadcrumb-elements-item">
            <i class="fas fa-file-upload"></i>
            Importar
        </a>
        <div class="breadcrumb-elements-item dropdown p-0">
            <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-users"></i>
                Ver usuarios por roles
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('usuarios') }}" class="dropdown-item"><i class="fas fa-user-lock"></i>Ver todos</a>
                @if (count($roles)>0)
                    @foreach ($roles as $rol_i)
                        <a href="{{ route('usuarios',$rol_i->name) }}" class="dropdown-item">
                            <i class="fas fa-user-lock"></i>{{ $rol_i->name }}
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')

<div class="card">
  
    <div class="card-body">
        <div class="table-responsive">
            {!! $dataTable->table()  !!}
        </div>
    </div>
</div>

@prepend('scriptsHeader')
    <link rel="stylesheet" href="{{ asset('librarys/DataTables/datatables.min.css') }}">
    <script src="{{ asset('librarys/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{-- confirm --}}
    <link rel="stylesheet" href="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('librarys/jquery-confirm/dist/jquery-confirm.min.js') }}"></script>
@endprepend

@push('scriptsFooter')
    <script>
        $('#menuUsuarios').addClass('active')
    </script>
     {!! $dataTable->scripts() !!}
@endpush
@endsection
