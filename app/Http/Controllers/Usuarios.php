<?php

namespace App\Http\Controllers;

use App\DataTables\UsuariosDataTable;
use App\Http\Requests\User\RqActualizar;
use App\Http\Requests\User\RqGuardar;
use App\Imports\UsersImport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class Usuarios extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Administrador|Usuarios']);
    }

    public function index(UsuariosDataTable $usuariosDataTable,$rolName=null)
    {
        $data = array(
            'roles'=>Role::all()
        );
        return $usuariosDataTable->with(['rol'=>$rolName])->render('usuarios.index',$data);
    }

    public function nuevo()
    {
        $data = array(
            'roles'=>Role::where('name','!=','Administrador')->get()
        );
        return view('usuarios.nuevo',$data);
    }

    public function guardar(RqGuardar $request)
    {
        try {
            DB::beginTransaction();
            $user=new User();
            $this->proceso($user,$request);
            DB::commit();
            $request->session()->flash('success','Nuevo usuario ingresado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Usuario no guardado, vuelva intentar');
        }

        return redirect()->route('usuarios');
    }

    public function editar($idUser)
    {
        $data = array(
            'roles' => Role::all(),
            'user' => User::findOrFail($idUser) 
        );
        
        return view('usuarios.editar',$data);
        
    }

    public function actualizar(RqActualizar $request)
    {
        try {
            DB::beginTransaction();
            $user=User::findOrFail($request->id);
            $this->proceso($user,$request);
            DB::commit();
            $request->session()->flash('success','Usuario actualizado');
        } catch (\Throwable $th) {
            DB::rollback();
            $request->session()->flash('info','Usuario no actualizado, vuelva intentar');
        }
        return redirect()->route('usuarios');

    }

    public function eliminar(Request $request, $idUser)
    {
        $user=User::findOrFail($idUser);
        $this->authorize('eliminar',$user);
        try {
            DB::beginTransaction();
            if($user->delete()){
                Storage::delete($user->foto);
            }
            DB::commit();
            $request->session()->flash('success','Usuario eliminado');
        } catch (\Throwable $th) {
            $request->session()->flash('info','Usuario no eliminado');
            DB::rollback();
        }
        return redirect()->route('usuarios');
    }

    public function proceso($user,$request)
    {
        $user->email=$request->email;
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
        if($request->roles){
            $user->syncRoles($request->roles);
        }
        
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
        return $user;
    }

    public function importar()
    {
        $data = array('roles' => Role::all() );
        return view('usuarios.importar',$data);
    }

    public function importarGuardar(Request $request)
    {
        Excel::import(new UsersImport, $request->file('archivo'));
        $request->session()->flash('success','Usuarios importados');
        return redirect()->route('usuarios');
    }

}
