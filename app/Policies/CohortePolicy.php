<?php

namespace App\Policies;

use App\Models\Cohorte;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CohortePolicy
{
    use HandlesAuthorization;

    // @deivid, verificar si existe cohortes en  resgitro y postulacion para el registro en linea
    public function registro(?User $user)
    {
        
        if(Cohorte::where('estado','Postulación e inscripción')->count()>0){
            return true;
        }
        return false;
    }

  
    public function registrar(?User $user, Cohorte $cohorte)
    {
        if($cohorte->estado=='Postulación e inscripción'){
            return true;
        }
        return false;
    }

    public function accederMiCohorte(User $user, Cohorte $cohorte)
    {
        $ids_cohortes=$user->cohortesCoordinador->pluck('id')->toArray();
        if(in_array($cohorte->id,$ids_cohortes)){
            return true;
        }
        return false;
    }
    

}
