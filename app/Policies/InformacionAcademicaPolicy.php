<?php

namespace App\Policies;

use App\Models\User\InformacionAcademica;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InformacionAcademicaPolicy
{
    use HandlesAuthorization;

    // @deivid, actualizar informacion academica
    public function actualizar(User $user, InformacionAcademica $informacionAcademica)
    {
        if($informacionAcademica->user_id==$user->id){
            return true;
        }
        return false;
    }

    
}
