<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    public function admision()
    {
        return $this->belongsTo(Admision::class);
    }
}
