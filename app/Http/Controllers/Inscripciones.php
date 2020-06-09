<?php

namespace App\Http\Controllers;

use App\DataTables\Inscripcion\InscripcionesDataTable;
use App\DataTables\Inscripcion\RegistrosDataTable;
use App\DataTables\Inscripcion\RegistrosParaInscripcionDataTable;
use App\Models\Cohorte;
use App\Models\Inscripcion;
use App\Models\Maestria;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
class Inscripciones extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Realizar inscripciones']);
    }
    public function index()
    {
        $data = array('maestrias' =>Maestria::has('cohortes')->get());
        return view('inscripciones.index',$data);
    }
    public function obtenerCohortesMaestria(Request $request)
    {
        $request->validate(['maestria'=>'required']);
        $maestria=Maestria::findOrFail($request->maestria);
        return response()->json($maestria->cohortes()->orderBy('numero','desc')->get());
    }

    public function listado(RegistrosDataTable $regTable,InscripcionesDataTable $inscTable,$idCohorte)
    {
        $cohorte=Cohorte::findOrFail($idCohorte);
        $data = array('regTable' =>$regTable ,'inscTable'=>$inscTable,'cohorte'=>$cohorte);
        if (request()->get('table') == 'registrosTable') {
            return $regTable->with('idCohorte',$idCohorte)->render('inscripciones.lista', $data);
        }
        return $inscTable->with('idCohorte',$idCohorte)->render('inscripciones.lista', $data);
    }

    public function nuevo($idReg)
    {
        $registro=Registro::findOrFail($idReg);
        $data = array('reg' => $registro );
        return view('inscripciones.inscribir',$data);
    }
    
    public function hojaVida($idReg)
    {
        $reg=Registro::findOrFail($idReg);
        $data = array('user' => $reg->user);
        $pdf = PDF::loadView('usuarios.perfil.hojaVida', $data)
            ->setOption('header-html', view('estaticas.header'))
            ->setOption('footer-html', view('estaticas.footer'))
            ->setOption('margin-bottom', 10);
        return $pdf->inline('Hoja de vida.pdf');
    }

    
    public function formularioRegistro($idReg)
    {
        $data = array('registro' => Registro::findOrFail($idReg));
        $pdf = PDF::loadView('estaticas.formulario', $data)
            ->setOption('header-html', view('estaticas.header'))
            ->setOption('footer-html', view('estaticas.footer'))
            ->setOption('margin-bottom', 10);
        return $pdf->inline('Formulario de registro.pdf');
    }


    public function guardar(Request $request)
    {
        $request->validate([
            'registro'=>'required|exists:registros,id',
            'informacionLaboral'=>'required|exists:informacion_laborals,id',
            'informacionAcademica'=>'required|exists:informacion_academicas,id',
            'descripcion'=>'nullable|string|max:255'
        ]);
        $reg=Registro::findOrFail($request->registro);
        $this->authorize('inscribir',$reg);
        try {
            DB::beginTransaction();
            $ins=new Inscripcion();
            $ins->cohorte_id=$reg->cohorte->id;
            $ins->registro_id=$reg->id;
            $ins->user_id=$reg->user->id;
            $ins->informacionLaborals_id=$reg->user->informacionLaboral->id;
            $ins->informacionAcademicas_id=$request->informacionAcademica;
            $ins->descripcion=$request->descripcion;
            $ins->creado_x=Auth::id();
            $ins->save();
            $request->session()->flash('success','Inscripción ingresado exitosamente');
            
            DB::commit();
            return redirect()->route('verInscripcion',$ins->id);
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Inscripción no completada, por favor vuelva intentar');
            return redirect()->route('nuevaInscripcion',$request->registro)->withInput();
        }
        
        
    }

    public function eliminar(Request $request,$idInscri)
    {
        $inscri=Inscripcion::findOrFail($idInscri);
        try {
            $inscri->delete();
            $request->session()->flash('success','Inscripción elimanado exitosamente');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Inscripción no elimanado');
        }
        return redirect()->route('inscripciones',$inscri->registro->cohorte->id);
    }

    public function ver($idInscripcion)
    {
        $incri=Inscripcion::findOrFail($idInscripcion);
        $data = array('inscri' => $incri );
        return view('inscripciones.ver',$data);
    }

    public function formularioInscripcion($idInscri)
    {
        $inscri=Inscripcion::findOrFail($idInscri);
        $data = array('inscri' => $inscri);
        $pdf = PDF::loadView('inscripciones.formulario', $data)
            ->setOption('header-html', view('estaticas.header'))
            ->setOption('footer-html', view('estaticas.footer'))
            ->setOption('margin-bottom', 10);
        return $pdf->inline('Formulario de inscripción.pdf');
    }

    public function actualizar(Request $request)
    {
        $request->validate([
            'inscripcion'=>'required|exists:inscripcions,id',
            'informacionAcademica'=>'required|exists:informacion_academicas,id',
            'descripcion'=>'nullable|string|max:255'
        ]);
        $ins=Inscripcion::findOrFail($request->inscripcion);
        try {
            DB::beginTransaction();
            $ins->informacionAcademicas_id=$request->informacionAcademica;
            $ins->descripcion=$request->descripcion;
            $ins->editado_x=Auth::id();
            $ins->save();
            $request->session()->flash('success','Inscripción actualizado exitosamente');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Inscripción no completada, por favor vuelva intentar');
        }
        return redirect()->route('verInscripcion',$ins->id);
    }

    public function obtenerRegistrosCohorte(RegistrosParaInscripcionDataTable  $dataTable, $idCohorte)
    {
        return $dataTable->with('idCohorte',$idCohorte)->render('inscripciones.obtenerRegistros');
        
    }

    public function pdf($idCohorte)
    {
        $cohorte=Cohorte::findOrFail($idCohorte);
        $data = array('inscripciones' => $cohorte->inscripciones );
        $pdf = PDF::loadView('inscripciones.pdf', $data)
            ->setOption('header-html', view('estaticas.header'))
            ->setOption('footer-html', view('estaticas.footer'))
            ->setOption('margin-bottom', 10);
        return $pdf->download('Listado de inscripciones.pdf');
    }
}
