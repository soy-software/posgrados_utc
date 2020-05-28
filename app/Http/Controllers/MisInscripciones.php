<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
class MisInscripciones extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $data = array('inscripciones' => $user->inscripciones,'user'=>$user );
        return view('misInscripciones.index',$data);
    }

    public function verFormulario($idIns)
    {
        $ins=Inscripcion::findOrFail($idIns);
        $this->authorize('miInscripcion',$ins);
        $data = array('user' => $ins->user);
        $pdf = PDF::loadView('usuarios.perfil.hojaVida', $data)
            ->setOption('header-html', view('estaticas.header'))
            ->setOption('footer-html', view('estaticas.footer'))
            ->setOption('margin-bottom', 10);
        return $pdf->inline('Hoja de vida.pdf');
    }
}
