<?php

namespace App\Policies;

use App\Models\Inscripcion;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InscripcionPolicy
{
    use HandlesAuthorization;

    public function miInscripcion(User $user, Inscripcion $inscripcion)
    {
        if($user->id==$inscripcion->user->id){
            return true;
        }
        return false;
    }
}
