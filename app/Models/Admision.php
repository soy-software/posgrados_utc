<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Admision extends Model
{
    // @deivid, una usuario pertenece a una admision
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cohorte()
    {
        return $this->belongsTo(Cohorte::class);
    }

    // @deivid, una admision tiene una entrevista
    public function entrevistas_m()
    {
        return $this->belongsToMany(BancoPregunta::class, 'entrevistas', 'admision_id', 'bancoPreguntas_id')
        ->withPivot('nota','opcion','id');
    }

}
