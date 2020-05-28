<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
  
 
    // @deivid, un regitro tiene un acohorte
    public function cohorte()
    {
        return $this->belongsTo(Cohorte::class);
    }

    // @deivid, un regitro tiene un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // @deivid, un registro tiene una inscripcion
    public function inscripcion()
    {
        return $this->hasOne(Inscripcion::class);
    }
}
