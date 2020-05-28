@extends('layouts.app',['title'=>'Información personal'])
@section('breadcrumbs', Breadcrumbs::render('miPerfilInfoPersonal'))
@section('content')

<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

    @include('usuarios.perfil.menu')
  
    <!-- Right content -->
    <div class="tab-content w-100">
      <div class="tab-pane fade active show">
        <form action="{{ route('actualizarMiPerfilInfoPersonal') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('usuarios.formEditar',['user'=>$user])
        </form>
      </div>
    </div>
    <!-- /right content -->
  </div>
  <!-- /inner container -->



@push('scriptsFooter')
    <script>
        $('#menuInformacionPersonal').addClass('active')
    </script>
    <script src="{{ asset('js/mapaUser.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bcJ39miYRDXIr4ux3484nqQP1XqS9Bw&callback=initMap" async defer></script>
@endpush
@endsection
