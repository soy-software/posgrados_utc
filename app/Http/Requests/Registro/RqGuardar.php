<?php

namespace App\Http\Requests\Registro;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RqGuardar extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rg_tipo_identificacion='';
        switch ($this->input('tipo_identificacion')) {
            case 'Cédula':
                $rg_tipo_identificacion='ecuador:ci|unique:users';
                break;
            case 'Ruc persona Natural':
                $rg_tipo_identificacion='ecuador:ruc|unique:users';
                break;
            case 'Ruc Sociedad Pública':
                $rg_tipo_identificacion='ecuador:ruc_spub|unique:users';
                break;
            case 'Ruc Sociedad Privada':
                $rg_tipo_identificacion='ecuador:ruc_spriv|unique:users';
                break;
            case 'Pasaporte':
                $rg_tipo_identificacion='unique:users';
                break;
        }

        if(Auth::check()){
            return[
                'cohorte'=>'required|exists:cohortes,id',
            ];
        }else{
            return [
                'cohorte'=>'required|exists:cohortes,id',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'primer_nombre'=>'required|string|max:255', 
                'segundo_nombre'=>'required|string|max:255', 
                'primer_apellido'=>'required|string|max:255',
                'segundo_apellido'=>'required|string|max:255',
                'tipo_identificacion'=>'required|in:Cédula,Ruc persona Natural,Ruc Sociedad Pública,Ruc Sociedad Privada,Pasaporte',
                'identificacion'=>'required|string|'.$rg_tipo_identificacion,
                'telefono'=>'nullable|numeric|digits_between:1,15',
                'celular'=>'required|numeric|digits_between:1,15',
                'lat'=>'nullable|max:255|string',
                'lng'=>'nullable|max:255|string', 
                'direccion'=>'nullable|max:255|string', 
                'titulo'=>'required|max:255|string',
                'especialidad'=>'required|max:255|string', 
                'institucion'=>'required|max:255|string', 
                
            ];
        }
        
    }
}
