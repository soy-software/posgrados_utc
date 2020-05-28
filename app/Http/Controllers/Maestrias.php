<?php

namespace App\Http\Controllers;

use App\DataTables\MaestriaDataTable;
use App\Http\Requests\Maestria\RqActualizar;
use App\Http\Requests\Maestria\RqGuardar;
use App\Models\Maestria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Maestrias extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Maestrías']);
    }
    public function index(MaestriaDataTable $maestriaDataTable)
    {
        return $maestriaDataTable->render('maestrias.index');
    }

    public function nuevo()
    {
        return view('maestrias.nuevo');
    }

    public function guardar(RqGuardar $request)
    {
        try {
            DB::beginTransaction();
            $maestria=new Maestria();
            $this->proceso($maestria,$request);
            DB::commit();
            $request->session()->flash('success','Maestría ingresado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Maestría no ingresado');
        }
        return redirect()->route('maestrias');

    }

    public function editar($idMaestria)
    {
        $data = array('maestria' => Maestria::findOrFail($idMaestria) );
        return view('maestrias.editar',$data);
    }

    public function actualizar(RqActualizar $request)
    {
        try {
            DB::beginTransaction();
            $maestria=Maestria::findOrFail($request->id);
            $this->proceso($maestria,$request);
            DB::commit();
            $request->session()->flash('success','Maestría actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Maestría no actualizado');
        }
        return redirect()->route('maestrias');

    }

    public function eliminar(Request $request,$idMaestria)
    {
        $maestria=Maestria::findOrFail($idMaestria);
        try {
            DB::beginTransaction();
            if($maestria->delete()){
                Storage::delete($maestria->foto);
            }
            DB::commit();
            $request->session()->flash('success','Maestría eliminado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Maestría no eliminado');
        }
        return redirect()->route('maestrias');
    }

    public function proceso($maestria,$request)
    {
        $maestria->nombre=$request->nombre;
        $maestria->tipo_programa=$request->tipo_programa;
        $maestria->campo_amplio=$request->campo_amplio;
        $maestria->campo_especifico=$request->campo_especifico;
        $maestria->campo_detallado=$request->campo_detallado;
        $maestria->programa=$request->programa;
        $maestria->titulo=$request->titulo;
        $maestria->codificacion_programa=$request->codificacion_programa;
        $maestria->lugar_ejecucion=$request->lugar_ejecucion;
        $maestria->duracion=$request->duracion;
        $maestria->tipo_periodo=$request->tipo_periodo;
        $maestria->numero_horas=$request->numero_horas;
        $maestria->resolucion=$request->resolucion;
        $maestria->fecha_resolucion=$request->fecha_resolucion;
        $maestria->modalidad=$request->modalidad;
        $maestria->vigencia=$request->vigencia;
        $maestria->paralelos=$request->paralelos;
        $maestria->fecha_aprobacion=$request->fecha_aprobacion;
        $maestria->capacidad_x_paralelo=$request->capacidad_x_paralelo;
        $maestria->save();
        if ($request->hasFile('foto')) {
            if ($request->file('foto')->isValid()) {
                $extension = $request->foto->extension();
                Storage::delete($maestria->foto);
                $path = Storage::putFileAs(
                    'public/maestrias', $request->file('foto'), Str::slug($maestria->nombre, '_').'_'.$maestria->id.'.'.$extension
                );
                $maestria->foto=$path;
                $maestria->save();
            }
        }
        return $maestria;
    }
}
