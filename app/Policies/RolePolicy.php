<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    // @deivid, estos roles establecidos en el seeder no se epueden eliminar
    public function eliminar(User $user, Role $role)
    {
        $roles = array(
            'Administrador',
            'Secretaría académica',
            'Departamento financiero tesorería',
            'Coordinador de maestría',
            'Postulante',
            'Aspirante',
            'Alumnos',
            'Docente',
        );

        if(in_array($role->name,$roles)){
            return false;
        }
        if(count($role->users)>0){
            return false;
        }

        return true;
    }

    // @deivid, los permisos en estos roles no se pueden actualizar
    public function sincronizar(User $user, Role $role)
    {
        if($role->name=='Administrador'){
            return false;
        }
        return true;
    }

}
