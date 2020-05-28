<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class MallaCurricular extends Model
{
    // @deivid, un malla tiene una materia
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    // @deivid, una malla tiene un docente
    public function docente()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // @deivid, una malla tiene un paralelo
    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class,'paralelo_id');
    }
}
