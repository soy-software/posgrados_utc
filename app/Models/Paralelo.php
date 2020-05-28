<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paralelo extends Model
{
    public function cohorte()
    {
        return $this->belongsTo(Cohorte::class);
    }

    // @deivid, un paralelo tiene muchas materias
    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'malla_curriculars', 'paralelo_id', 'materia_id');
    }
}
