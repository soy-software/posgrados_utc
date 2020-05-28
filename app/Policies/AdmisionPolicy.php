<?php

namespace App\Policies;

use App\Models\Admision;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmisionPolicy
{
    use HandlesAuthorization;

    // @deivid, un usuario puede subir un comprobante para la matricula, cuando sea la admison aprobada
    // , cuando el comprobante este sin validar
    public function subirComprobanteParaMatricula(User $user, Admision $admision)
    {
        if($admision->user_id==$user->id && $admision->estado=='Aprobado' && $admision->estado_factura=='Sin validar'){
            return true;
        }
        return false;
    }
}
