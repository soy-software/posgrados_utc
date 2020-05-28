@extends('layouts.app',['title'=>'Restablecer contraseña'])
@section('breadcrumbs', Breadcrumbs::render('resetPassword'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                            <div class="md-form mt-0">
                                <i class="fas fa-envelope prefix"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                           
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scriptsFooter')
    <script>
        $('#menuLogin').addClass('active');
    </script>
@endprepend
@endsection
