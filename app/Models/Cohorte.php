<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cohorte extends Model
{
    // @deivid, un cohorte tiene coordinadores
    public function coordinadores()
    {
        return $this->belongsToMany(User::class, 'cohorte_coordinadors', 'cohorte_id', 'user_id');
    }

    // @deivid, ver si coordinador esat en corte
    public function hasCoordinador($idCohorte,$idUser)
    {
        return CohorteCoordinador::where(['cohorte_id'=>$idCohorte,'user_id'=>$idUser])->first()??null;
    }

    // @deivid, una corte pertenece una maestria
    public function maestria()
    {
        return $this->belongsTo(Maestria::class);
    }

    // @deivid, una cohorte tiene varios inscripciones

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    //  @deivid, una cohorte tiene varias preguntas
    public function bancoPreguntas()
    {
        return $this->hasMany(BancoPregunta::class);
    }
}
