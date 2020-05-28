<?php

namespace App\Models;

use App\Models\User\InformacionAcademica;
use App\Models\User\InformacionLaboral;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    // @deivid, una inscripcion pertenece un registro
    public function registro()
    {
        return $this->belongsTo(Registro::class);
    }

    // @deivid , una inscripcion pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // @deivid , una inscripcion pertenece a una cohorte
    public function cohorte()
    {
        return $this->belongsTo(Cohorte::class);
    }

    // @deivid , una inscripcion pertenece a una InformacionLaboral
    public function informacionLaboral()
    {
        return $this->belongsTo(InformacionLaboral::class,'informacionLaborals_id');
    }

    // @deivid , una inscripcion pertenece a una InformacionAcademica
    public function informacionAcademica()
    {
        return $this->belongsTo(InformacionAcademica::class,'informacionAcademicas_id');
    }

    // @deivi una inscripcion tiene un solo admision
    public function admision()
    {
        return $this->hasOne(Admision::class);
    }
}
