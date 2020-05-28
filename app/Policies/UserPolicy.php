<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // @deivid, usuario no se puede autoeliminar, tampoco si es Administrador
    public function eliminar(User $user, User $model)
    {
        if($user->id==$model->id){
            return false;
        }
        if($model->hasRole('Administrador')){
            return false;
        }
        return true;
    }

}
