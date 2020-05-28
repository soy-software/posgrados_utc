<?php

namespace App\Policies;

use App\Models\Registro;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistroPolicy
{
    use HandlesAuthorization;



    public function tieneRegistros(User $user)
    {
        if(count($user->registros)>0){
            return true;
        }
        return false;
    }

   public function subirComprobanteRegistro(User $user,Registro $registro)
   {
       if($registro->estado=='Sin validar' && $user->id==$registro->user->id){
           return true;
       }
       return false;
   }

    // @deivid, inscribir en una cohorte    
   public function inscribir(User $user,Registro $registro)
   {
       if(!$registro->inscripcion){
           return true;
       }
       return false;
   }
}
