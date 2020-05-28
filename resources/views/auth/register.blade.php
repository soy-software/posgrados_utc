@extends('layouts.app',['title'=>'Registro'])
@section('breadcrumbs', Breadcrumbs::render('registro'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                   
                    
                    <form method="POST" action="{{ route('register') }}">

                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
