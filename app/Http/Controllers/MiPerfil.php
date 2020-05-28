<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RqActualizarInfoAcademica;
use App\Http\Requests\User\RqActualizarInfoLaboral;
use App\Http\Requests\User\RqActualizarInfoPersonal;
use App\Http\Requests\User\RqGuardarInfoAcademica;
use App\Models\User\InformacionAcademica;
use App\Models\User\InformacionLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use PDF;

class MiPerfil extends Controller
{
    public function index(Request $request)
    {
        $data = array('user' => Auth::user());
        
        return view('usuarios.perfil.index',$data);
    }

    public function personal()
    {
        $data = array('user' => Auth::user(),'roles'=>Role::where('id',0)->get(),'editarEmail'=>'ok');
        return view('usuarios.perfil.personal',$data);
    }

    public function actualizarInfoPersonal(RqActualizarInfoPersonal $request)
    {
        try {
            DB::beginTransaction();
            $user=Auth::user();
            $user->name=$request->name;
            if($request->password){
                $user->password=Hash::make($request->password);
            }
            $user->primer_nombre=$request->primer_nombre;
            $user->segundo_nombre=$request->segundo_nombre;
            $user->primer_apellido=$request->primer_apellido;
            $user->segundo_apellido=$request->segundo_apellido;
            $user->sexo=$request->sexo;
            $user->tipo_identificacion=$request->tipo_identificacion;
            $user->identificacion=$request->identificacion;
            $user->fecha_nacimiento=$request->fecha_nacimiento;
            $user->estado_civil=$request->estado_civil;
            $user->etnia=$request->etnia;
            $user->telefono=$request->telefono;
            $user->celular=$request->celular;
            $user->nacionalidad=$request->nacionalidad;
            $user->tiene_discapacidad=$request->tiene_discapacidad;
            $user->porcentaje_discapacidad=$request->porcentaje_discapacidad??0;
            $user->tiene_carnet_conadis=$request->tiene_carnet_conadis;
            $user->porcentaje_carnet_conadis=$request->porcentaje_carnet_conadis??0;
            $user->lat=$request->lat;
            $user->lng=$request->lng;
            $user->direccion=$request->direccion;
            $user->save();
            if ($request->hasFile('foto')) {
                if ($request->file('foto')->isValid()) {
                    $extension = $request->foto->extension();
                    Storage::delete($user->foto);
                    $path = Storage::putFileAs(
                        'public/usuarios', $request->file('foto'), Str::slug($user->email, '_').'_'.$user->id.'.'.$extension
                    );
                    $user->foto=$path;
                    $user->save();
                }
            }
            DB::commit();
            $request->session()->flash('success','Información personal actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Información personal no actualizado, vuelva intentar');
        }
        return redirect()->route('miPerfilInfoPersonal');
    }

    public function laboral()
    {
        $data = array('info' => Auth::user()->informacionLaboral,'user'=>Auth::user());
        return view('usuarios.perfil.laboral',$data);
    }

    public function actualizarInfoLaboral(RqActualizarInfoLaboral $request)
    {
        try {
            DB::beginTransaction();
            $user=Auth::user();
            $info=$user->informacionLaboral;
            if (!$info) {
                $info=new InformacionLaboral();
                $info->user_id=$user->id;
            } 
            
            $info->trabaja=$request->trabaja;
            $info->tipo_institucion=$request->tipo_institucion;
            $info->empresa=$request->empresa;
            $info->cargo=$request->cargo;
            $info->pais=$request->pais;
            $info->provincia=$request->provincia;
            $info->canton=$request->canton;
            $info->telefono=$request->telefono;
            $info->extencion=$request->extencion;
            $info->email=$request->email;
            $info->save();
            DB::commit();
            $request->session()->flash('success','Información laboral actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Información laboral no actualizado, vuelva intentar');
        }
        return redirect()->route('miPerfilInfoLaboral');
    }
    public function academica()
    {
        $user=Auth::user();
        $data = array('user' =>$user ,'infoAcademicos'=>$user->informacionAcademicos);
        return view('usuarios.perfil.academica',$data);
    }

    public function guardarInfoAcademica(RqGuardarInfoAcademica $request)
    {
        try {
            DB::beginTransaction();
            $info=new InformacionAcademica();
            $info->institucion=$request->institucion;
            $info->nivel=$request->nivel;
            $info->tipo_institucion=$request->tipo_institucion;
            $info->titulo=$request->titulo;
            $info->especialidad=$request->especialidad;
            $info->duracion=$request->duracion;
            $info->fecha_graduacion=$request->fecha_graduacion;
            $info->calificacion_grado=$request->calificacion_grado;
            $info->pais=$request->pais;
            $info->provincia=$request->provincia;
            $info->canton=$request->canton;
            $info->user_id=Auth::id();
            $info->save();
            DB::commit();
            $request->session()->flash('success','Información académica ingresado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Información académica no ingresado, vuelva intentar');
        }
        return redirect()->route('miPerfilInfoAcademica');
    }

    public function editarAcademica($idInfoAcade)
    {
        $info=InformacionAcademica::findOrFail($idInfoAcade);
        $this->authorize('actualizar',$info);
        $data = array('info'=>$info,'user'=>Auth::user());
        return view('usuarios.perfil.editarAcademica',$data);
    }

    public function actualizarInfoAcademica(RqActualizarInfoAcademica $request)
    {
        $info=InformacionAcademica::findOrFail($request->id);
        try {
            DB::beginTransaction();
            $info->institucion=$request->institucion;
            $info->nivel=$request->nivel;
            $info->tipo_institucion=$request->tipo_institucion;
            $info->titulo=$request->titulo;
            $info->especialidad=$request->especialidad;
            $info->duracion=$request->duracion;
            $info->fecha_graduacion=$request->fecha_graduacion;
            $info->calificacion_grado=$request->calificacion_grado;
            $info->pais=$request->pais;
            $info->provincia=$request->provincia;
            $info->canton=$request->canton;
            $info->save();
            DB::commit();
            $request->session()->flash('success','Información académica actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Información académica no actualizado, vuelva intentar');
        }
        return redirect()->route('miPerfilInfoAcademica');
    }

    public function eliminarAcademica(Request $request,$idInfoAcade)
    {
        $info=InformacionAcademica::findOrFail($idInfoAcade);
        $this->authorize('actualizar',$info);
        try {
            DB::beginTransaction();
            $info->delete();
            DB::commit();
            $request->session()->flash('success','Información académica eliminado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Información académica no eliminado, vuelva intentar');
        }
        return redirect()->route('miPerfilInfoAcademica');
    }

    public function hojaVida()
    {
        $data = array('user' => Auth::user());
        $pdf = PDF::loadView('usuarios.perfil.hojaVida', $data)
            ->setOption('header-html', view('estaticas.header'))
            ->setOption('footer-html', view('estaticas.footer'))
            ->setOption('margin-bottom', 10);
        return $pdf->inline('Hoja de vida.pdf');
    }
}
