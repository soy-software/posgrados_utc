@extends('layouts.app',['title'=>'Inicio'])
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')

<div class="login-form">
    <div class="card text-center">
        <img class="card-img-top bg-indigo" src="{{ asset('images/utc-logo.png') }}" alt="UTC-POSGRADOS">
        <div class="card-body">
          <h5 class="card-title">
              {{ config('app.name','POSGRADO UTC') }}
          </h5>
          <p class="card-text">
            Gracias por preferirnos, nos alegra que estés con nosotros.
          </p>
        </div>
        <div class="card-footer">
            Sistema de gestión de posgrado UTC <small>Versión 0.9</small>
        </div>
      </div>
</div>



@push('scriptsFooter')
    <script>
        $('#menuInicio').addClass('active')
        $('#contenido').addClass('content d-flex justify-content-center align-items-center');
    </script>
@endpush
@endsection
