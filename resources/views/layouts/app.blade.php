<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ucfirst($title ?? '') }} | {{ config('app.name', 'POSGRADO UTC') }}</title>

    <!-- MDB icon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('librarys/mdb/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('librarys/mdb/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('librarys/mdb/css/style.css') }}">

	<!-- Limitless -->
	
	<link href="{{ asset('fonts/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/layout.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/colors.min.css') }}" rel="stylesheet" type="text/css">
	

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('librarys/mdb/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('librarys/mdb/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('librarys/mdb/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('librarys/notify.min.js') }}"></script>
	{{-- JS LIBRARYS --}}
	@stack('scriptsHeader')
	
	{{-- JS API --}}
	<script src="{{ asset('js/app.js') }}"></script>

	

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark bg-indigo navbar-static">
		<div class="navbar-brand">
			<a href="{{ url('/') }}" class="d-inline-block">
				<img src="{{ asset('images/logo_light.png') }}" alt="">
			</a>
		</div>

		<div class="d-md-none" id="botonPerfil">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			@auth
				<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
					<i class="icon-paragraph-justify3"></i>
				</button>
				
			@endauth
			
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				
				@auth
				@if (Auth::user()->hasVerifiedEmail())
				<li class="nav-item">
					<a href="#" class="nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
				@endif
				@endauth
				
			</ul>

			@auth
			<span class="navbar-text ml-md-3">
				<span class="badge badge-mark border-green-300 mr-2"></span>
				Bienvenido, {{ Auth::user()->name }}!
			</span>
			@endauth

			<ul class="navbar-nav ml-md-auto">
				
				{{-- <li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<i class="icon-make-group mr-2"></i>
						Connect
					</a>

					<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
						<div class="dropdown-content-body p-2">
							<div class="row no-gutters">
								<div class="col-12 col-sm-4">
									<a href="#" class="d-block text-default text-center ripple-dark rounded p-3">
										<i class="icon-github4 icon-2x"></i>
										<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Github</div>
									</a>

									<a href="#" class="d-block text-default text-center ripple-dark rounded p-3">
										<i class="icon-dropbox text-blue-400 icon-2x"></i>
										<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Dropbox</div>
									</a>
								</div>
								
								<div class="col-12 col-sm-4">
									<a href="#" class="d-block text-default text-center ripple-dark rounded p-3">
										<i class="icon-dribbble3 text-pink-400 icon-2x"></i>
										<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Dribbble</div>
									</a>

									<a href="#" class="d-block text-default text-center ripple-dark rounded p-3">
										<i class="icon-google-drive text-success-400 icon-2x"></i>
										<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Drive</div>
									</a>
								</div>

								<div class="col-12 col-sm-4">
									<a href="#" class="d-block text-default text-center ripple-dark rounded p-3">
										<i class="icon-twitter text-info-400 icon-2x"></i>
										<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Twitter</div>
									</a>

									<a href="#" class="d-block text-default text-center ripple-dark rounded p-3">
										<i class="icon-youtube text-danger icon-2x"></i>
										<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Youtube</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<i class="icon-pulse2 mr-2"></i>
						Activity
					</a>
					
					<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
						<div class="dropdown-content-header">
							<span class="font-size-sm line-height-sm text-uppercase font-weight-semibold">Latest activity</span>
							<a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>
						</div>

						<div class="dropdown-content-body dropdown-scrollable">
							<ul class="media-list">
								<li class="media">
									<div class="mr-3">
										<a href="#" class="btn bg-success-400 rounded-round btn-icon"><i class="icon-mention"></i></a>
									</div>

									<div class="media-body">
										<a href="#">Taylor Swift</a> mentioned you in a post "Angular JS. Tips and tricks"
										<div class="font-size-sm text-muted mt-1">4 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="mr-3">
										<a href="#" class="btn bg-pink-400 rounded-round btn-icon"><i class="icon-paperplane"></i></a>
									</div>
									
									<div class="media-body">
										Special offers have been sent to subscribed users by <a href="#">Donna Gordon</a>
										<div class="font-size-sm text-muted mt-1">36 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="mr-3">
										<a href="#" class="btn bg-blue rounded-round btn-icon"><i class="icon-plus3"></i></a>
									</div>
									
									<div class="media-body">
										<a href="#">Chris Arney</a> created a new <span class="font-weight-semibold">Design</span> branch in <span class="font-weight-semibold">Limitless</span> repository
										<div class="font-size-sm text-muted mt-1">2 hours ago</div>
									</div>
								</li>

								<li class="media">
									<div class="mr-3">
										<a href="#" class="btn bg-purple-300 rounded-round btn-icon"><i class="icon-truck"></i></a>
									</div>
									
									<div class="media-body">
										Shipping cost to the Netherlands has been reduced, database updated
										<div class="font-size-sm text-muted mt-1">Feb 8, 11:30</div>
									</div>
								</li>

								<li class="media">
									<div class="mr-3">
										<a href="#" class="btn bg-warning-400 rounded-round btn-icon"><i class="icon-comment"></i></a>
									</div>
									
									<div class="media-body">
										New review received on <a href="#">Server side integration</a> services
										<div class="font-size-sm text-muted mt-1">Feb 2, 10:20</div>
									</div>
								</li>

								<li class="media">
									<div class="mr-3">
										<a href="#" class="btn bg-teal-400 rounded-round btn-icon"><i class="icon-spinner11"></i></a>
									</div>
									
									<div class="media-body">
										<strong>January, 2018</strong> - 1320 new users, 3284 orders, $49,390 revenue
										<div class="font-size-sm text-muted mt-1">Feb 1, 05:46</div>
									</div>
								</li>
							</ul>
						</div>

						<div class="dropdown-content-footer bg-light">
							<a href="#" class="font-size-sm line-height-sm text-uppercase font-weight-semibold text-grey mr-auto">All activity</a>
							<div>
								<a href="#" class="text-grey" data-popup="tooltip" title="Clear list"><i class="icon-checkmark3"></i></a>
								<a href="#" class="text-grey ml-2" data-popup="tooltip" title="Settings"><i class="icon-gear"></i></a>
							</div>
						</div>
					</div>
				</li> --}}


				<li class="nav-item" id="menuRegistrar">
					<a class="nav-link" href="{{ route('registro') }}">Registro</a>
				</li>

				@guest
					<li class="nav-item" id="menuLogin">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item" id="menuRegistro">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
					@endif
				@else
				<li class="nav-item">
					<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<i class="icon-switch2"></i>
						<span class="d-md-none ml-2">{{ __('Logout') }}</span>
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</li>
				@endguest


				

			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		@auth
		@if (Auth::user()->hasVerifiedEmail())
		@include('layouts.menu')
		@endif
		@endauth
		


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							@yield('breadcrumbs')
						</div>
						@hasSection ('headerElements')
							<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>	
						@endif
					</div>

					<div class="header-elements d-none">
						@yield('headerElements')
						{{-- <div class="breadcrumb justify-content-center">
							<a href="#" class="breadcrumb-elements-item">
								<i class="icon-comment-discussion mr-2"></i>
								Support
							</a>

							<div class="breadcrumb-elements-item dropdown p-0">
								<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
									<i class="icon-gear mr-2"></i>
									Settings
								</a>

								<div class="dropdown-menu dropdown-menu-right">
									<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
									<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
									<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
								</div>
							</div>
						</div> --}}

					</div>
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content" id="contenido">

				@if ($errors->any())
					<div class="alert alert-primary alert-dismissible fade show" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li><strong>{{ $error }}</strong></li>
							@endforeach
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif


				@foreach (['success', 'warn', 'info', 'error'] as $msg)
					@if(Session::has($msg))
					<script>
						$.notify("{{ Session::get($msg) }}", "{{ $msg }}");
					</script>
					@endif
				@endforeach


				@yield('content')
			</div>
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Información
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; {{ date('Y') }}. <a href="{{ url('/') }}">{{ config('app.name','POSGRADO UTC') }}</a> by <a href="https://soysoftware.com/" target="_blank">Soysoftware</a>
					</span>

					<ul class="navbar-nav ml-lg-auto">
						<li class="nav-item">
							<a href="https://www.facebook.com/posgradoutc/" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook" class="navbar-nav-link"><i class="fab fa-facebook-f text-primary"></i></a>
						</li>
						<li class="nav-item">
							<a href="https://www.youtube.com/channel/UCJ9bM-HIXmb1mUUBsDVR-ig" target="_blank" data-toggle="tooltip" data-placement="top" title="YouTube" class="navbar-nav-link"><i class="fab fa-youtube text-danger"></i></a>
						</li>
						<li class="nav-item">
							<a href="http://avirtuales.utc.edu.ec/moodleposgrados/" target="_blank" data-toggle="tooltip" data-placement="top" title="Moodle" class="navbar-nav-link font-weight-semibold"><i class="fab fa-maxcdn text-warning"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

	{{-- JS MDB --}}
	<script type="text/javascript" src="{{ asset('librarys/mdb/js/mdb.min.js') }}"></script>

	{{-- JS LOBRARYS --}}
	@stack('scriptsFooter')

	<script>
		 $('[data-toggle="tooltip"]').tooltip()
		 $('table').on('draw.dt', function() {
			$('[data-toggle="tooltip"]').tooltip();
		})

		function eliminar(arg){
			var url=$(arg).data('url');
			var msg=$(arg).data('msg');
			$.confirm({
				title: 'Eliminar!',
				content: msg,
				theme: 'modern',
				type:'blue',
				icon:'far fa-sad-cry',
				closeIcon:true,
				buttons: {
					confirmar: {
						btnClass: 'btn-blue',
						action: function(){
							location.replace(url);
						}
					},
					cancelar: {
						action: function(){

						}
        			}
				}
			});
		}
		
	</script>

</body>
</html>
