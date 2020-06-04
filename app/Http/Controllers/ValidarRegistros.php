<?php

namespace App\Http\Controllers;

use App\DataTables\Tesoreria\RegistroDataTable;
use App\Models\Cohorte;
use App\Models\Maestria;
use App\Models\Registro;
use App\Notifications\NotificarValidarRegistro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidarRegistros extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Validar registros']);
    }

    public function index()
    {
        $data = array('maestrias' =>Maestria::has('cohortes')->get());
        return view('validarRegistros.index',$data);
    }
    
    public function obtenerCohortesMaestria(Request $request)
    {
        $request->validate(['maestria'=>'required']);
        $maestria=Maestria::findOrFail($request->maestria);
        return response()->json($maestria->cohortes);
    }
    public function obtenerRegistroPorCohorte(RegistroDataTable $dataTable, $idCohorte)
    {
        return $dataTable->with('idCohorte',$idCohorte)->render('validarRegistros.obtenerRegistro');
    }

    public function validarRegistro(Request $request)
    {
        $request->validate([
            'registro'=>'exists:registros,id',
            'factura'=>'nullable|string|max:255'
        ]);
        try {
            $msg="";
            $registro=Registro::findOrFail($request->registro);
            if($request->factura){
                $registro->estado='Validado';    
                $msg="Registro validado exitosamente, se envió información a ".$registro->user->email;
                $registro->user->notify(new NotificarValidarRegistro($registro));
            }else{
                $registro->estado='Sin validar';    
                $msg="Registro Sin validar";
            }
            $registro->factura=$request->factura;
            
            $registro->editado_x=Auth::id();
            $registro->save();
            return response()->json(['success'=>$msg]);
        } catch (\Throwable $th) {
            return response()->json(['info'=>'Registro no validado']);
        }
    }

    

    
}
