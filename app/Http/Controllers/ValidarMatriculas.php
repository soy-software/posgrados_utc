<?php

namespace App\Http\Controllers;

use App\DataTables\ValidarMatriculaDataTable;
use App\Models\Admision;
use App\Models\Maestria;
use App\Notifications\NotificarValidacionMatricula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidarMatriculas extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Validar matrícula']);
    }

    public function index()
    {
        $data = array('maestrias' =>Maestria::has('cohortes')->get());
        return view('validarMatriculas.index',$data);
    }

    public function obtenerCohortesMaestria(Request $request)
    {
        $request->validate(['maestria'=>'required']);
        $maestria=Maestria::findOrFail($request->maestria);
        return response()->json($maestria->cohortes()->orderBy('numero','desc')->get());
    }

    public function obtenerAdmisionesCohorte(ValidarMatriculaDataTable  $dataTable, $idCohorte)
    {
        return $dataTable->with('idCohorte',$idCohorte)->render('validarMatriculas.obtenerAdmisiones');
        
    }
    public function validarMatricula(Request $request)
    {
        $request->validate([
            'admision'=>'exists:admisions,id',
            'factura'=>'nullable|string|max:255'
        ]);
        try {
            $msg="";
            $admision=Admision::findOrFail($request->admision);
            if($request->factura){
                $admision->estado_factura='Validado';    
                $msg="Matrícula validado exitosamente, se envió información a ".$admision->user->email;
                $admision->user->notify(new NotificarValidacionMatricula($admision));
            }else{
                $admision->estado_factura='Sin validar';    
                $msg="Admisión Sin validar";
            }
            $admision->factura=$request->factura;
            
            $admision->editado_x=Auth::id();
            $admision->save();
            return response()->json(['success'=>$msg]);
        } catch (\Throwable $th) {
            return response()->json(['info'=>'Admisión no validado'.$th->getMessage()]);
        }
    }
}
