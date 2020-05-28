<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public function maestria()
    {
        return $this->belongsTo(Maestria::class);
    }
}
