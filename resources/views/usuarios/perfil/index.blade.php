@extends('layouts.app',['title'=>'Mi perfil'])
@section('breadcrumbs', Breadcrumbs::render('miperfil'))
@section('content')

<!-- Inner container -->
<div class="d-md-flex align-items-md-start">

  @include('usuarios.perfil.menu')

  <!-- Right content -->
  <div class="tab-content w-100">
    <div class="tab-pane fade active show">
        <div class="card">
          <div class="card-body">
            <blockquote class="blockquote">
              <p>{{ $user->apellidos_nombres }}</p>
              <footer class="card-blockquote">{{ $user->email }} <br><cite title="{{ $user->direccion }}">{{ $user->direccion }}</cite></footer>
            </blockquote>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            Hoja de vida
          </div>
          <div class="card-body">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="{{ route('hojaVidaMiPerfil') }}" allowfullscreen></iframe>
            </div>
          </div>
          
        </div>
    </div>
  </div>
  <!-- /right content -->
</div>
<!-- /inner container -->


@push('scriptsFooter')
    <script>
        $('#menuMiPerfil').addClass('active')
    </script>
@endpush
@endsection
