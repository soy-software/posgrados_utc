<?php

namespace App\Imports;

use App\Models\Cohorte;
use App\Models\Maestria;
use App\Models\Registro;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DatosExcel implements ToModel, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row[8])){
            $user=User::where('email',$row[8])->first();
            if(!$user){
                $user=new User();
                $user->name=$row[2];
                $user->email=$row[8];
                $user->password=Hash::make($row[0]);
                $nombres=explode(' ',$row[3]);
                $apellidos=explode(' ',$row[2]);
                $user->identificacion=isset($row[0])?$row[0]:'';
                $user->primer_nombre= isset($nombres[0])?$nombres[0]:'';
                $user->segundo_nombre=isset($nombres[1])?$nombres[1]:'';
                $user->primer_apellido=isset($apellidos[0])?$apellidos[0]:'';
                $user->segundo_apellido=isset($apellidos[1])?$apellidos[1]:'';
                $user->celular=isset($row[7])?$row[7]:'';
                $user->direccion=$row[11].' - '.$row[12];
                $user->save();
            }
           
        }

        if(isset($row[10])){
            $maestria=Maestria::where('nombre',$row[10])->first();
            if(!$maestria){
                $maestria=new Maestria();
                $maestria->nombre=$row[10];
                $maestria->save();
            }

            for ($i=1; $i <=3 ; $i++) { 
                $cohorte=Cohorte::where(['numero'=>$i,'maestria_id'=>$maestria->id])->first();
                if(!$cohorte){
                    $cohorte=new Cohorte();
                    $cohorte->numero=$i;
                    $cohorte->maestria_id=$maestria->id;
                    $cohorte->valor_inscripcion=50;
                    $cohorte->sede='Latacunga';
                    $cohorte->modalidad='Presencial';
                    $cohorte->paralelo=1;
                    $cohorte->valor_inscripcion=50;
                    $cohorte->valor_matricula=0;
                    $cohorte->valor_colegiatura=0;
                    $cohorte->save();
                }
                if($cohorte->numero==3){
                    $cohorte->estado='Postulación e inscripción';
                    $cohorte->save();

                    $registro=Registro::where(['cohorte_id'=>$cohorte->id,'user_id'=>$user->id])->first();
                    if(!$registro){
                        $registro=new Registro();
                        $registro->valor=$cohorte->valor_inscripcion;
                        $registro->cohorte_id=$cohorte->id;
                        $registro->user_id=$user->id;
                        $registro->institucion=isset($row[4]);
                        $registro->titulo=isset($row[5]);
                        $registro->especialidad=isset($row[5]);
                        $registro->creado_x=Auth::id();
                        try {
                            $registro->created_at=Carbon::parse(isset($row[1]));
                        } catch (\Throwable $th) {
                            $registro->created_at=Carbon::now();
                        }
                        $registro->save();
                    }

                }


            }

        }
            
  
    }
}
