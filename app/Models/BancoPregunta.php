<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BancoPregunta extends Model
{
     // @deivid, una corte pertenece una maestria
     public function cohorte()
     {
         return $this->belongsTo(Cohorte::class);
     }
}
