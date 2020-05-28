<?php

namespace App;

use App\Models\Cohorte;
use App\Models\CohorteCoordinador;
use App\Models\Registro;
use App\Models\User\InformacionAcademica;
use App\Models\User\InformacionLaboral;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // @deivid, obtener nombres completos
    public function getApellidosNombresAttribute()
    {
        return "{$this->primer_apellido} {$this->segundo_apellido} {$this->primer_nombre} {$this->segundo_nombre}";
    }


    // @deivid, un usuario coordinador tiene varios cohortes
    public function cohortesCoordinador()
    {
        return $this->belongsToMany(Cohorte::class, 'cohorte_coordinadors', 'user_id', 'cohorte_id');
    }

    // @deivid, un usuario tiene  varios registros
    public function registros()
    {
        return $this->hasMany(Registro::class);
    }
    
    // @deivid un usuario tiene un informacion laboral
    public function informacionLaboral()
    {
        return $this->hasOne(InformacionLaboral::class);
    }

    // @deivid usuario tiene varios informacion academicos
    public function informacionAcademicos()
    {
        return $this->hasMany(InformacionAcademica::class);
    }

    // @deivid, no se pueden modifica los valores de retur=>'personal,laboral,academico,ok'
    public function actualizarInformacion()
    {
        $tieneRegistro=$this->registros->where('estado','Validado')->count();
        
        if($tieneRegistro>0 && $this->verificarAtributosVacios()){
            return 'personal';
        }

        if($tieneRegistro>0 && !$this->informacionLaboral){
            return 'laboral';
        }
        if(count($this->informacionAcademicos)==0 && $tieneRegistro>0){
            return 'academico';
        }
        return 'ok';
    }

    public function verificarAtributosVacios()
    {
        $attributes = array(
            'primer_nombre',
            'segundo_nombre',
            'primer_apellido',
            'segundo_apellido',
            'identificacion',
            'nacionalidad',
            'estado_civil',
            'sexo',
            'fecha_nacimiento',
            'etnia',
            'celular',
            'lat',
            'lng',
            'direccion'
        );
        foreach ($attributes as $attribute) {
            if (empty($this->$attribute)) {
                return true;
            }
        }

        return false;
    }
    
}
