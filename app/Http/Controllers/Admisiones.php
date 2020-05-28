<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\Cohorte;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Admisiones extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Maestrías']);
    }

    public function index($idCohorte)
    {
        $cohorte=Cohorte::findOrFail($idCohorte);
        $data = array('inscritos' => $cohorte->inscripciones,'cohorte'=>$cohorte);
        return view('admisiones.index',$data);
    }

    public function actualizarExamen(Request $request)
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        $request->validate([
            'cohorte'=>'required|exists:cohortes,id',
            'inscripcion'=> 'required|array',
            'inscripcion.*'=> 'required|exists:inscripcions,id',
            'nota'=>'required|array',
            'nota.*'=>'required|numeric|between:0,100.00|regex:'.$rg_decimal,
        ]);
        
        try {
            DB::beginTransaction();
            foreach ($request->inscripcion as $ins) {
                $inscripcion=Inscripcion::findOrFail($ins);
                $admision=$inscripcion->admision;
                if(!$admision){
                    $admision=new Admision();
                    $admision->cohorte_id=$request->cohorte;
                    $admision->inscripcion_id=$ins;
                    $admision->user_id=$inscripcion->user->id;
                    $admision->creado_x=Auth::id();
                    $admision->examen=$request->nota[$ins];
                    $admision->save();
                }else{
                    $admision->examen=$request->nota[$ins];
                    $admision->editado_x=Auth::id();
                    $admision->save();
                }
            }
            DB::commit();
            $request->session()->flash('success','Notas de examén actualizado, exitosamente');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Notas de examén no actualizado, vuelva intentar');
        }
        return redirect()->route('admision',$request->cohorte);
    }
}
