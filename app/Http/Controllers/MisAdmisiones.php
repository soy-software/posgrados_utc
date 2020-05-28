<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class MisAdmisiones extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $data = array('admisiones' => $user->admisiones,'user'=>$user );
        return view('misAdmisiones.index',$data);
    }

    public function subirComprobanteParaMatricula($idAdmision)
    {
        $admision=Admision::findOrFail($idAdmision);
        $this->authorize('subirComprobanteParaMatricula',$admision);
        $data = array('admision' => $admision );
        return view('misAdmisiones.comprobanteMatricula',$data);
    }

    public function guardarComprobanteParaMatricula(Request $request)
    {
        $request->validate([
            'foto'=>'mimes:png,jpg,jpeg',
            'admision'=>'required|exists:admisions,id'
        ]);
        $admision=Admision::findOrFail($request->admision);
        $this->authorize('subirComprobanteParaMatricula',$admision);
        if ($request->hasFile('foto')) {
            if ($request->file('foto')->isValid()) {
                $extension = $request->foto->extension();
                Storage::delete($admision->comprobante);
                $path = Storage::putFileAs(
                    'public/matriculas', $request->file('foto'), Str::slug($admision->id, '_').'_'.$admision->user->id.'.'.$extension
                );
                $admision->comprobante=$path;
                $admision->editado_x=Auth::id();
                $admision->save();
            }
        }
        return response()->json(['success'=>'Comprobante de matríla ingresado exitosamente']);
    }

   
}
