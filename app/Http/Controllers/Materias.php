<?php

namespace App\Http\Controllers;

use App\DataTables\MateriasDataTable;
use App\Http\Requests\Materia\RqActualizar;
use App\Http\Requests\Materia\RqGuardar;
use App\Models\Maestria;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Materias extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Maestrías']);
    }
    public function index(MateriasDataTable $maestriaDataTable,$idMaestria)
    {
        $data = array('maestria' => Maestria::findOrFail($idMaestria) );
        return $maestriaDataTable->with('idMaestria',$idMaestria)->render('materias.index',$data);
    }

    public function guardar(RqGuardar $request)
    {
        try {
            DB::beginTransaction();
            $materia=new Materia();
            $materia->maestria_id=$request->maestria;
            $materia->nombre=$request->nombre;
            $materia->save();
            DB::commit();
            $request->session()->flash('success','Matería ingresado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Matería no ingresado');
        }
        return redirect()->route('materias',$request->maestria);

    }

    public function editar($idMateria)
    {
        $data = array('materia' => Materia::findOrFail($idMateria) );
        return view('materias.editar',$data);
    }

    public function actualizar(RqActualizar $request)
    {
        $materia=Materia::findOrFail($request->id);
        try {
            DB::beginTransaction();
            $materia->nombre=$request->nombre;
            $materia->save();
            DB::commit();
            $request->session()->flash('success','Matería actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Matería no actualizado');
        }
        return redirect()->route('materias',$materia->maestria->id);
    }

    public function eliminar(Request $request,$idMateria)
    {
        $materia=Materia::findOrFail($idMateria);
        try {
            $materia->delete();
            $request->session()->flash('success','Matería eliminado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Matería no eliminado');
        }
        return redirect()->route('materias',$materia->maestria->id);
    }


}
