<?php

namespace App\Http\Middleware;

use Closure;

class VerificarInformacionUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch ($request->user()->actualizarInformacion()) {
            case 'personal':
                $request->session()->flash('info','Actualizar información personal');
                return redirect()->route('miPerfilInfoPersonal');
                break;
            case 'laboral':
                $request->session()->flash('info','Actualizar información laboral');
                return redirect()->route('miPerfilInfoLaboral');
                break;
            case 'academico':
                $request->session()->flash('info','Actualizar información académica');
                return redirect()->route('miPerfilInfoAcademica');
                break;
            default:
                break;
        }
        
        return $next($request);
    }
}
