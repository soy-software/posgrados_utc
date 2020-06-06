<?php

namespace App\Http\Controllers;

use App\Models\BancoPregunta;
use App\Models\Cohorte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BancoPreguntas extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Maestrías']);
    }
    public function index($idCohorte)
    {
        $cohorte=Cohorte::findOrFail($idCohorte);
        if($cohorte->bancoPreguntas->count()<=0){
            for ($i=0; $i <=10 ; $i++) { 
                $bp=new BancoPregunta();
                $bp->pregunta='Pregunta '.$i;
                $bp->cohorte_id=$cohorte->id;
                $bp->creado_x=Auth::id();
                $bp->save();
            }
        }
        $data = array('bancoPreguntas' => $cohorte->bancoPreguntas,'cohorte'=>$cohorte );
        return view('bancoPreguntas.index',$data);
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            "id"    => "required|array",
            "id.*"  => "required|exists:banco_preguntas,id",
            "pregunta"    => "required|array",
            "pregunta.*"  => "required|string|max:255",
            'cohorte'=>'required|exists:cohortes,id'
        ]);
        try {
            DB::beginTransaction();
            foreach ($request->id as $idPre) {
                $bp=BancoPregunta::findOrFail($idPre);
                $bp->pregunta=$request->pregunta[$idPre];
                $bp->save();
                $bp->editado_x=Auth::id();
                $bp->save();
            }
            DB::commit();
            $request->session()->flash('success','Banco de preguntas actualizado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Banco de preguntas no actualizado, vuelva intentar');
            DB::rollback();
        }
        return redirect()->route('bancoPreguntas',$request->cohorte);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'cohorte_nuevo'=>'required|exists:cohortes,id',
            'pregunta_nueva'=>'required|string|max:255'
        ]);
        $cohorte=Cohorte::findOrFail($request->cohorte_nuevo);
        try {
            if(count($cohorte->bancoPreguntas)<10){
                $bp=new BancoPregunta();
                $bp->pregunta=$request->pregunta_nueva;
                $bp->cohorte_id=$request->cohorte_nuevo;
                $bp->save();
                $bp->creado_x=Auth::id();
                $bp->save();
                $request->session()->flash('success','Nueva pregunta ingresado');
            }else{
                $request->session()->flash('info','No puede ingresar más de 10 preguntas');
            }
        } catch (\Throwable $th) {
            $request->session()->flash('info','Banco de preguntas no ingresado, vuelva intentar');
        }
        return redirect()->route('bancoPreguntas',$request->cohorte_nuevo);
    }

    public function eliminar(Request $request, $idPre)
    {
        $bp=BancoPregunta::findOrFail($idPre);
        try {
            $bp->delete();
            $request->session()->flash('success','Pregunta eliminado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Pregunta no eliminado');
        }
        return redirect()->route('bancoPreguntas',$bp->cohorte->id);

    }
}
