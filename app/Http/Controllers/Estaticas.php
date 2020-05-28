<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registro\RqGuardar;
use App\Models\Cohorte;
use App\Models\Registro;
use App\Notifications\NotificarRegistro;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;
use Artisan;
class Estaticas extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function index()
    {
        return view('welcome');
        
        // Artisan::call('cache:clear');
        // Artisan::call('config:clear');
        // Artisan::call('config:cache');
        // Artisan::call('storage:link');
        // Artisan::call('key:generate');
        // Artisan::call('migrate:fresh --seed');
    }


    // @deivid,  registro a la una cohorte
    public function registro()
    {
        
        $data = array(
            'cohortes' => Cohorte::where('estado','Postulación e inscripción')->get(),
        );
        return view('estaticas.registro',$data);
    }

    public function guardarRegistro(RqGuardar $request)
    {
        $cohorte=Cohorte::findOrFail($request->cohorte);
        $this->authorize('registrar',$cohorte);
        try {
            DB::beginTransaction();
            if (Auth::check()) {
                $user=Auth::user();
            }else{
                $user=new User();
                $user->name = $request->email;
                $user->email =$request->email;
                $user->password = Hash::make($request->password);
                $user->primer_nombre=$request->primer_nombre;
                $user->segundo_nombre=$request->segundo_nombre;
                $user->primer_apellido=$request->primer_apellido;
                $user->segundo_apellido=$request->segundo_apellido;
                $user->tipo_identificacion=$request->tipo_identificacion;
                $user->identificacion=$request->identificacion;
                $user->telefono=$request->telefono;
                $user->celular=$request->celular;
                $user->lat=$request->lat;
                $user->lng=$request->lng;
                $user->direccion=$request->direccion;
                $user->save();
            }

            $reg=Registro::where(['user_id'=>$user->id,'cohorte_id'=>$cohorte->id])->first();
            
            if(!$reg){
                $reg=new Registro();
                $reg->cohorte_id=$cohorte->id;
                $reg->user_id=$user->id;
                $reg->titulo=$request->titulo??'';
                $reg->especialidad=$request->especialidad??'';
                $reg->institucion=$request->institucion??'';
                $reg->valor=$cohorte->valor_inscripcion;
                $reg->creado_x=$user->id;
                $reg->save();   
            }
             
           $user->notify(new NotificarRegistro($reg));

            DB::commit();
            $request->session()->flash('RegistroOk',['msg'=>'Registro exitoso en '.$cohorte->maestria->nombre.' COHORTE '.$cohorte->numero.', se envió información a '.$reg->user->email,'id'=>$reg->id]);
            return redirect()->route('registro');

        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Ocurrio un error.!, porfavor vuelva intentar '.$th->getMessage());
            return redirect()->route('registro')->withInput();
        }
        

    }

    public function verFormularioRegistroPdf($idReg)
    {
        $data = array('registro' => Registro::findOrFail($idReg));
        $pdf = PDF::loadView('estaticas.formulario', $data)
            ->setOption('header-html', view('estaticas.header'))
            ->setOption('footer-html', view('estaticas.footer'))
            ->setOption('margin-bottom', 10);
        return $pdf->inline('Formulario de registro.pdf');
    }

    public function descargarFormularioRegistroPdf($idReg)
    {
        $data = array('registro' => Registro::findOrFail($idReg));
        $pdf = PDF::loadView('estaticas.formulario', $data)
            ->setOption('header-html', view('estaticas.header'))
            ->setOption('footer-html', view('estaticas.footer'))
            ->setOption('margin-bottom', 10);
        return $pdf->download('Formulario de registro.pdf');
    }
}
