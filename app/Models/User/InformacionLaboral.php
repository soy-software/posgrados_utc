<?php

namespace App\Models\User;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InformacionLaboral extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
