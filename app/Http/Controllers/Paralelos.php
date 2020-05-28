<?php

namespace App\Http\Controllers;

use App\DataTables\ParalelosDataTable;
use App\Http\Requests\Paralelo\RqActualizar;
use App\Http\Requests\Paralelo\RqGuardar;
use App\Models\Cohorte;
use App\Models\Paralelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Paralelos extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Maestrías']);
    }
    public function index(ParalelosDataTable $paralelosDataTable,$idCohorte)
    {
        $data = array('cohorte' => Cohorte::findOrFail($idCohorte) );
        return $paralelosDataTable->with('idCohorte',$idCohorte)->render('paralelos.index',$data);
    }

    public function guardar(RqGuardar $request)
    {
        try {
            DB::beginTransaction();
            $paralelo=new Paralelo();
            $paralelo->cohorte_id=$request->cohorte;
            $paralelo->nombre=$request->nombre;
            $paralelo->fecha_inicio=$request->fecha_inicio;
            $paralelo->fecha_fin=$request->fecha_fin;
            $paralelo->creado_x=Auth::id();
            $paralelo->save();
            DB::commit();
            $request->session()->flash('success','Paralelo ingresado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Paralelo no ingresado');
        }
        return redirect()->route('paralelos',$request->cohorte);
    }

    public function eliminar(Request $request,$idParalelo)
    {
        $paralelo=Paralelo::findOrFail($idParalelo);
        try {
            $paralelo->delete();
            $request->session()->flash('success','Paralelo eliminado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Paralelo no eliminado');
        }
        return redirect()->route('paralelos',$paralelo->cohorte->id);
    }

    public function editar($idParalelo)
    {
        $data = array('paralelo' => Paralelo::findOrFail($idParalelo) );
        return view('paralelos.editar',$data);
    }
    public function actualizar(RqActualizar $request)
    {
        $paralelo=Paralelo::findOrFail($request->id);
        try {
            DB::beginTransaction();
            $paralelo->nombre=$request->nombre;
            $paralelo->fecha_inicio=$request->fecha_inicio;
            $paralelo->fecha_fin=$request->fecha_fin;
            $paralelo->editado_x=Auth::id();
            $paralelo->save();
            DB::commit();
            $request->session()->flash('success','Paralelo actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Paralelo no actualizado');
        }
        return redirect()->route('paralelos',$paralelo->cohorte->id);
    }
}
