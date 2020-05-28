@extends('layouts.app',['title'=>'Editar usuario'])
@section('breadcrumbs', Breadcrumbs::render('editarUsuario',$user))
@section('content')

<form action="{{ route('actualizarUsuario') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('usuarios.formEditar',['user'=>$user])
</form>

@prepend('scriptsHeader')
@endpush

@push('scriptsFooter')
    <script>
        $('#menuUsuarios').addClass('active')
    </script>
    <script src="{{ asset('js/mapaUser.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bcJ39miYRDXIr4ux3484nqQP1XqS9Bw&callback=initMap" async defer></script>

@endprepend
@endsection
