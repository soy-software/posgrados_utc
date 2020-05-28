@extends('layouts.app',['title'=>'Inicio'])
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')

<h1>ok</h1>
@push('scriptsFooter')
    <script>
        $('#menuInicio').addClass('active')
    </script>
@endpush
@endsection
