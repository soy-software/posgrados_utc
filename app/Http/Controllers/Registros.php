<?php

namespace App\Http\Controllers;

use App\DataTables\Tesoreria\RegistroDataTable;
use App\Models\Cohorte;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Registros extends Controller
{
    public function misRegistros()
    {
        $data = array('registros' => Auth::user()->registros );
        return view('registros.misRegistros',$data);
    }
    
    public function subirComprobanteRegistro($idReg)
    {
        $reg=Registro::findOrFail($idReg);
        $this->authorize('subirComprobanteRegistro',$reg);
        $data = array('registro' => $reg );
        return view('registros.subirComprobanteRegistro',$data);
    }

    public function guardarComprobanteRegistro(Request $request)
    {
        $request->validate([
            'foto'=>'mimes:png,jpg,jpeg',
            'registro'=>'required|exists:registros,id'
        ]);
        $registro=Registro::findOrFail($request->registro);
        $this->authorize('subirComprobanteRegistro',$registro);
        if ($request->hasFile('foto')) {
            if ($request->file('foto')->isValid()) {
                $extension = $request->foto->extension();
                Storage::delete($registro->foto);
                $path = Storage::putFileAs(
                    'public/registros', $request->file('foto'), Str::slug($registro->id, '_').'_'.$registro->user->id.'.'.$extension
                );
                $registro->foto=$path;
                $registro->editado_x=Auth::id();
                $registro->save();
            }
        }
        return response()->json(['success'=>'Comprobante ingresado exitosamente']);
    }

    
    
}
