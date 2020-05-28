<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrador']);
    }

    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('roles.index');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'rol' => 'required|unique:roles,name|max:255',
        ]);
        Role::create(['name' => $request->rol]);
        $request->session()->flash('success','Rol ingresado');
        return redirect()->route('roles');
    }

    public function permisos($idRol)
    {
        $rol=Role::findOrFail($idRol);
        $permisos=Permission::all();
        return view('roles.permisos',['rol'=>$rol,'permisos'=>$permisos]);
    }

    public function sincronizar(Request $request)
    {
       $request->validate([
            "permisos"    => "nullable|array",
            "permisos.*"  => "nullable|exists:permissions,id",
            'rol'=>'required|exists:roles,id',
        ]);
        
        $rol=Role::findOrFail($request->rol);
        $this->authorize('sincronizar',$rol);
        $rol->syncPermissions($request->permisos);
        $request->session()->flash('success','Permisos actualizados');
        return redirect()->route('permisos',$rol->id);
    }

    public function eliminar( Request $request, $idRol)
    {
        $role=Role::findOrFail($idRol);
        $this->authorize('eliminar',$role);
        try {
            $role->delete();
            $request->session()->flash('success','Rol eliminado');
        } catch (\Exception $th) {
            $request->session()->flash('error','No se puede eliminar rol');
        }
        return redirect()->route('roles');
    }
}
