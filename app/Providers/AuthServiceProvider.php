<?php

namespace App\Providers;

use App\Models\Admision;
use App\Models\Cohorte;
use App\Models\Inscripcion;
use App\Models\Registro;
use App\Models\User\InformacionAcademica;
use App\Policies\AdmisionPolicy;
use App\Policies\CohortePolicy;
use App\Policies\InformacionAcademicaPolicy;
use App\Policies\InscripcionPolicy;
use App\Policies\RegistroPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class=>RolePolicy::class,
        User::class=>UserPolicy::class,
        Cohorte::class=>CohortePolicy::class,
        Registro::class=>RegistroPolicy::class,
        InformacionAcademica::class=>InformacionAcademicaPolicy::class,
        Inscripcion::class=>InscripcionPolicy::class,
        Admision::class=>AdmisionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
