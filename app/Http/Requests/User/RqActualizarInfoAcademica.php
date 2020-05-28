<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizarInfoAcademica extends FormRequest
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
        $rg_decimal="/^[0-9,]+(\.\d{0,2})?$/";
        return [
            'id'=>'required|exists:informacion_academicas,id',
            'institucion'=>'required|string|max:255',
            'nivel'=>'required|string|max:255|in:TÉCNOLOGICO SUPERIOR,LICENCIATURA,TERCER NIVEL,CUARTO NIVEL,DOCTORADO',
            'tipo_institucion'=>'required|in:PÚBLICA,PRIVADA,MIXTA',
            'titulo'=>'required|string|max:255',
            'especialidad'=>'required|string|max:255',
            'duracion'=>'required|integer|min:0',
            'fecha_graduacion'=>'required|date',
            'calificacion_grado'=>'required|regex:'.$rg_decimal,
            'pais'=>'required|string|max:255',
            'provincia'=>'required|string|max:255', 
            'canton'=>'required|string|max:255'
        ];
    }
}
