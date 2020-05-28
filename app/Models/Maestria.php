<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maestria extends Model
{
    public function materias()
    {
        return $this->hasMany(Materia::class);
    }


    // @deivid, una maestria tiene varios cohortes
    public function cohortes()
    {
        return $this->hasMany(Cohorte::class);
    }
}
