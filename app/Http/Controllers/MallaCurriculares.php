<?php

namespace App\Http\Controllers;

use App\DataTables\MallaCurricular\DocentesDataTable;
use App\DataTables\MallaCurricularDataTable;
use App\Http\Requests\MallaCurricular\RqActualizar;
use App\Http\Requests\MallaCurricular\RqGuardar;
use App\Models\MallaCurricular;
use App\Models\Paralelo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MallaCurriculares extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Maestrías']);
    }
    public function index(MallaCurricularDataTable $mallaCurricularDataTable,$idParalelo)
    {
        $data = array('paralelo' => Paralelo::findOrFail($idParalelo) );
        return $mallaCurricularDataTable->with('idParalelo',$idParalelo)->render('mallaCurriculares.index',$data);
    }

    public function nuevo(DocentesDataTable $docentesDataTable,$idParalelo) 
    {
        $paralelo=Paralelo::findOrFail($idParalelo);
        $data = array(
            'paralelo' => $paralelo,
            'materias'=>$paralelo->cohorte->maestria->materias->whereNotIn('id',$paralelo->materias->pluck('id'))
        );
        return $docentesDataTable->render('mallaCurriculares.nuevo',$data);
    }

    public function guardar(RqGuardar $request)
    {
        try {
            DB::beginTransaction();
            $malla=new MallaCurricular();
            $malla->nivel=$request->nivel;
            $malla->categoria=$request->categoria;
            $malla->subindice=$request->subindice;
            $malla->paralelo_id=$request->paralelo;
            $malla->materia_id=$request->materia;
            $malla->user_id=$request->docente;
            $malla->creado_x=Auth::id();
            $malla->save();
            DB::commit();
            $request->session()->flash('success','Malla curricular ingresado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Malla curricular no ingresado');
        }
        return redirect()->route('mallaCurricular',$request->paralelo);
    }

    public function editar(DocentesDataTable $docentesDataTable,$idMalla) 
    {
         $malla=MallaCurricular::findOrFail($idMalla);
         $data = array(
            'malla' => $malla,
            'materias'=>$malla->paralelo->cohorte->maestria->materias
        );
        return $docentesDataTable->render('mallaCurriculares.editar',$data);
    }

    public function actualizar(RqActualizar $request)
    {
        $malla=MallaCurricular::findOrFail($request->id);
        try {
            DB::beginTransaction();
            $malla->nivel=$request->nivel;
            $malla->categoria=$request->categoria;
            $malla->subindice=$request->subindice;
            $malla->materia_id=$request->materia;
            $malla->user_id=$request->docente;
            $malla->editado_x=Auth::id();
            $malla->save();
            DB::commit();
            $request->session()->flash('success','Malla curricular actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Malla curricular no actualizado');
        }
        return redirect()->route('mallaCurricular',$malla->paralelo->id);
    }

    public function eliminar(Request $request,$idMalla)
    {
        $malla=MallaCurricular::findOrFail($idMalla);
        try {
            $malla->delete();
            $request->session()->flash('success','Malla curricular eliminado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Malla curricular no eliminado');
        }
        return redirect()->route('mallaCurricular',$malla->paralelo->id);
    }
}
