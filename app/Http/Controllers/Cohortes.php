<?php

namespace App\Http\Controllers;

use App\DataTables\CohortesDataTable;
use App\Http\Requests\Cohorte\RqActualizar;
use App\Http\Requests\Cohorte\RqGuardar;
use App\Models\Cohorte;
use App\Models\Maestria;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cohortes extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Maestrías']);
    }

    public function index(CohortesDataTable $cohortesDataTable,$idMaestria)
    {
        $maestria=Maestria::findOrFail($idMaestria);
        $data = array('maestria' => $maestria );
        return $cohortesDataTable->with('idMaestria',$maestria->id)->render('cohortes.index',$data);
    }

    public function nuevo($idMaestria)
    {
        $data = array(
            'maestria' => Maestria::findOrFail($idMaestria),
            'coordinadores'=>User::role('Coordinador de maestría')->get(),
            'numero'=>Cohorte::where('maestria_id',$idMaestria)->latest()->value('numero')+1
        );
        return view('cohortes.nuevo',$data);
    }

    public function guardar(RqGuardar $request)
    {
        try {
            DB::beginTransaction();
            $cohorte=new Cohorte();
            $this->proceso($cohorte,$request);
            $cohorte->creado_x=Auth::id();
            $cohorte->save();
            DB::commit();
            $request->session()->flash('success','Nueva cohorte creado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Cohorte no creado, vuelva intentar');
        }
        return redirect()->route('cohortes',$request->maestria);
    }

    public function editar($idCohorte)
    {
        $cohorte=Cohorte::findOrFail($idCohorte);
        $data = array(
            'cohorte' => $cohorte ,
            'coordinadores'=>User::role('Coordinador de maestría')->get(),
        );
        return view('cohortes.editar',$data);
    }

    public function actualizar(RqActualizar $request)
    {
        $cohorte=Cohorte::findOrFail($request->id);
        try {
            DB::beginTransaction();
            $this->proceso($cohorte,$request);
            DB::commit();
            $request->session()->flash('success','Cohorte actualizado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Cohorte no actualizado');
            DB::rollback();
        }
        return redirect()->route('cohortes',$cohorte->maestria->id);

    }

    public function eliminar(Request $request,$idCohorte)
    {
        $cohorte=Cohorte::findOrFail($idCohorte);
        try {
            $cohorte->delete();
            $request->session()->flash('success','Cohorte eliminado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Cohorte no eliminado');
        }
        return redirect()->route('cohortes',$cohorte->maestria->id);
    }
    public function proceso($cohorte,$request)
    {
        $cohorte->numero=$request->numero;
        $cohorte->sede=$request->sede;
        $cohorte->modalidad=$request->modalidad;
        if($request->maestria){
            $cohorte->maestria_id=$request->maestria;
        }
        $cohorte->paralelo=$request->paralelos;
        $cohorte->valor_inscripcion=$request->valor_inscripcion;
        $cohorte->valor_matricula=$request->valor_matricula;
        $cohorte->valor_colegiatura=$request->valor_colegiatura;
        if($request->estado){
            $cohorte->estado=$request->estado;
        }
        $cohorte->save();
        $cohorte->coordinadores()->sync($request->coordinadores);
        return $cohorte;
    }
}
