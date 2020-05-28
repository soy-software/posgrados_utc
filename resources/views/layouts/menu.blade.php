<!-- Main sidebar -->
<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Navegación</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    @if (Storage::exists(Auth::user()->foto))
                    <img src="{{ Storage::url(Auth::user()->foto) }}" class="img-fluid rounded-circle shadow-1 mb-3 border border-white" width="80" height="80" alt="">
                    @else
                    <img src="{{ asset('images/demo/users/face6.jpg') }}" class="img-fluid rounded-circle shadow-1 mb-3 border border-white" width="80" height="80" alt="">    
                    @endif
                    
                    
                    <h6 class="mb-0 text-white text-shadow-dark">
                        {{ Auth::user()->apellidos_nombres }}
                    </h6>
                    <span class="font-size-sm text-white text-shadow-dark">
                        {{ Auth::user()->email }}
                    </span>
                </div>
                                            
                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>Mi cuenta</span></a>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="{{ route('miperfil') }}" class="nav-link">
                            <i class="icon-user-plus"></i>
                            <span>Mi perfil</span>
                        </a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Principal</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link" id="menuInicio">
                        <i class="fas fa-home"></i>
                        <span>
                            Inicio
                        </span>
                    </a>
                </li>

                @if (count(Auth::user()->registros)>0)
                <li class="nav-item">
                    <a href="{{ route('misRegistros') }}" class="nav-link" id="misRegistros">
                        <i class="fas fa-user-edit"></i> <span>Mis registros</span>
                    </a>
                </li>
                @endif


                @if (count(Auth::user()->inscripciones)>0)
                <li class="nav-item">
                    <a href="{{ route('misInscripciones') }}" class="nav-link" id="misInscripciones">
                        <i class="fas fa-clipboard-check"></i> <span>Mis inscripciones</span>
                    </a>
                </li>
                @endif

                @if (count(Auth::user()->admisiones)>0)
                <li class="nav-item">
                    <a href="{{ route('misAdmisiones') }}" class="nav-link" id="misAdmisiones">
                        <i class="fas fa-network-wired"></i> <span>Mis admisiones</span>
                    </a>
                </li>
                @endif



                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Gestión</div> <i class="icon-menu" title="Gestión"></i></li>

                @can('Usuarios')
                <li class="nav-item">
                    <a href="{{ route('usuarios') }}" class="nav-link" id="menuUsuarios">
                        <i class="fas fa-users"></i> <span>Usuarios</span>
                    </a>
                </li>
                @endcan
                @can('Maestrías')
                <li class="nav-item">
                    <a href="{{ route('maestrias') }}" class="nav-link" id="menuMaestrias">
                        <i class="fas fa-journal-whills"></i> <span>Maestrías</span>
                    </a>
                </li>
                @endcan


                @can('Validar registros')
                    <li class="nav-item">
                        <a href="{{ route('validarRegistros') }}" class="nav-link" id="menuValidarRegistro">
                            <i class="fas fa-clipboard-check"></i> <span>Validar registros</span>
                        </a>
                    </li>
                @endcan

                @can('Realizar inscripciones')
                    <li class="nav-item">
                        <a href="{{ route('realizarInscripciones') }}" class="nav-link" id="menuRealizarInscripciones">
                            <i class="fas fa-clipboard-list"></i> <span>Realizar inscripciones</span>
                        </a>
                    </li>
                @endcan


                @if (count(Auth::user()->cohortesCoordinador)>0)
                    <li class="nav-item">
                        <a href="{{ route('misMaestrias') }}" class="nav-link" id="menuMisMaestrias">
                            <i class="fas fa-clipboard-list"></i> <span>Mis maestrías</span>
                        </a>
                    </li>
                @endif

                @role('Administrador')
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Seguridad</div> <i class="icon-menu" title="Seguridad"></i></li>
                <li class="nav-item">
                    <a href="{{ route('roles') }}" class="nav-link" id="menuRoles">
                        <i class="fas fa-user-lock"></i> <span>Roles y permisos</span>
                    </a>
                </li>
                @endrole
                


            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
    
</div>
<!-- /main sidebar -->