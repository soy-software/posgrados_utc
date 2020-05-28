<!-- Left sidebar component -->
<div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

    <!-- Sidebar content -->
    <div class="sidebar-content">

      <!-- Navigation -->
        <div class="card">
            <div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url({{ asset('images/backgrounds/panel_bg.png') }}); background-size: contain;">
                <div class="card-img-actions d-inline-block mb-3">
                    @if (Storage::exists($user->foto))
                    <img class="img-fluid rounded-circle" src="{{ Storage::url($user->foto) }}" width="170" height="170" alt="">
                    @else
                    <img class="img-fluid rounded-circle" src="{{ asset('images/demo/users/face6.jpg') }}" width="170" height="170" alt="">    
                    @endif
             
                </div>

                <h6 class="font-weight-semibold mb-0">
                    {{ $user->apellidos_nombres }}
                </h6>
                <span class="d-block opacity-75">
                    {{ $user->email }}
                </span>
            </div>

            <div class="card-body p-0">
                <ul class="nav nav-sidebar mb-2">
                    <li class="nav-item-header">Navegación</li>
                    <li class="nav-item">
                        <a href="{{ route('miperfil') }}" class="nav-link" id="menuMiPerfil">
                            <i class="icon-user"></i>
                                Mi perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('miPerfilInfoPersonal') }}" class="nav-link" id="menuInformacionPersonal">
                            <i class="fas fa-address-book"></i>
                            Información personal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('miPerfilInfoLaboral') }}" class="nav-link" id="menuInformacionLaboral">
                            <i class="fas fa-briefcase"></i>
                            Información laboral
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('miPerfilInfoAcademica') }}" class="nav-link" id="menuInformacionAcademica">
                            <i class="fas fa-user-graduate"></i>
                            Información académica
                            <span class="badge bg-success badge-pill ml-auto">{{ $user->informacionAcademicos()->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item-divider"></li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                            <i class="icon-switch2"></i>
                            Salir
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /navigation -->
    </div>
    <!-- /sidebar content -->
    
</div>
<!-- /left sidebar component -->


<script>

    $('#botonPerfil').append('<button class="navbar-toggler sidebar-mobile-component-toggle" type="button"><i class="icon-unfold"></i></button>');
    
</script>