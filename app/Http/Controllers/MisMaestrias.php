<?php

namespace App\Http\Controllers;

use App\DataTables\MiMaestrias\AdmisionDataTable;
use App\DataTables\MiMaestrias\InscritosDataTable;
use App\DataTables\MiMaestrias\RegistrosDataTable;
use App\DataTables\MiMaestriasDataTable;
use App\Models\Admision;
use App\Models\Cohorte;
use App\Models\Entrevista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MisMaestrias extends Controller
{
    public function index(MiMaestriasDataTable $dataTable)
    {        
        return $dataTable->render('misMaestrias.index');
    }
    public function registros(RegistrosDataTable $dataTable,$idCoh)
    {
        $cohorte=Cohorte::findOrFail($idCoh);
        $this->authorize('accederMiCohorte',$cohorte);
        $data = array('cohorte' => $cohorte );
        return $dataTable->with('idCohorte',$idCoh)->render('misMaestrias.registros',$data);
    }
    public function inscritos(InscritosDataTable $dataTable,$idCoh)
    {
        $cohorte=Cohorte::findOrFail($idCoh);
        $data = array('cohorte' => $cohorte );
        return $dataTable->with('idCohorte',$idCoh)->render('misMaestrias.inscritos',$data);
    }
    public function admision(AdmisionDataTable $dataTable,$idCoh)
    {
        $cohorte=Cohorte::findOrFail($idCoh);
        $data = array('cohorte' => $cohorte );
        return $dataTable->with('idCohorte',$idCoh)->render('misMaestrias.admision',$data);
    }

    public function admisionAtender($idAdmision)
    {
        $admision=Admision::findOrFail($idAdmision);
        $bp_isd=$admision->cohorte->bancoPreguntas->pluck('id');
        $admision->entrevistas_m()->sync($bp_isd);
        $data = array('admi' => $admision,'preguntas'=>$admision->entrevistas_m);
        return view('misMaestrias.atenderAdmision',$data);
    }
    public function admisionActualizarEntrevista(Request $request)
    {
        $request->validate([
            'admision'=>'required|exists:admisions,id',
            'preguntas' => 'required|array',
            'preguntas.*' => 'required|exists:entrevistas,id',
            'opcion'=>'required|array',
            'opcion.*'=>'required|in:Excelente,Muy bueno,Bueno,Regular,Pobre'
        ]);

        $admision=Admision::findOrFail($request->admision);
        
        $this->authorize('accederMiCohorte',$admision->cohorte);
        try {
            DB::beginTransaction();
            $total=0;
            foreach ($request->preguntas as $pre) {
                $entrevista=Entrevista::findOrFail($pre);
                $entrevista->opcion=$request->opcion[$pre];
                switch ($request->opcion[$pre]) {
                    case 'Excelente':
                        $entrevista->nota=3;
                        break;
                    case 'Muy bueno':
                        $entrevista->nota=2;
                        break;
                    case 'Bueno':
                        $entrevista->nota=1.50;
                        break;
                    case 'Regular':
                        $entrevista->nota=1;
                        break;
                    case 'Pobre':
                        $entrevista->nota=0.50;
                        break;
                }
                $entrevista->save();
                $total+=$entrevista->nota;
            }
            $entrevista->admision->entrevista=$total;
            $entrevista->admision->editado_x=Auth::id();
            $entrevista->admision->save();
            DB::commit();
            $request->session()->flash('success','Entrevista guardado exitosamente');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Entrevista no guardado, vuelva intentar');
            DB::rollback();
        }
        return redirect()->route('miCohorteAdmisionEntrevistaEnsayo',$request->admision);
    }

    public function admisionActualizarEnsayo(Request $request)
    {
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        $request->validate([
            'admision'=>'required|exists:admisions,id',
            'nota'=>'required|numeric|between:0,2.00|regex:'.$rg_decimal,
        ]);
        $admision=Admision::findOrFail($request->admision);
        $this->authorize('accederMiCohorte',$admision->cohorte);
        try {
            DB::beginTransaction();
            $admision->ensayo=$request->nota;
            $admision->editado_x=Auth::id();
            $admision->save();
            DB::commit();
            $request->session()->flash('success','Nota de ensayo guardado exitosamente');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Nota de ensayo no guardado, vuelva intentar');
        }
        return redirect()->route('miCohorteAdmisionEntrevistaEnsayo',$request->admision);

    }

    public function admisionAprobarReprobar(Request $request)
    {
        
        $request->validate([
            'admision'=>'required|exists:admisions,id',
            'estado'=>'required|in:Aprobado,Reprobado'
        ]);
        $admision=Admision::findOrFail($request->admision);
        $this->authorize('accederMiCohorte',$admision->cohorte);
        try {
            DB::beginTransaction();
            $admision->estado=$request->estado;
            $admision->editado_x=Auth::id();
            $admision->save();
            DB::commit();
            $request->session()->flash('success','Admisión '.$admision->estado.' actualizado exitosamente');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Admisión no guardado, vuelva intentar');
        }
        return redirect()->route('miCohorteAdmisionEntrevistaEnsayo',$request->admision);

    }
    
    
}
