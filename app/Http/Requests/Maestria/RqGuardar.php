<?php

namespace App\Http\Requests\Maestria;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'nombre'=>'required|string|max:255|unique:maestrias,nombre',
            'tipo_programa'=>'nullable|string|max:255',
            'campo_amplio'=>'nullable|string|max:255',
            'campo_especifico'=>'nullable|string|max:255',
            'campo_detallado'=>'nullable|string|max:255',
            'programa'=>'nullable|string|max:255',
            'titulo'=>'nullable|string|max:255',
            'codificacion_programa'=>'nullable|string|max:255',
            'lugar_ejecucion'=>'nullable|string|max:255',
            'duracion'=>'nullable|string|max:255',
            'tipo_periodo'=>'nullable|string|max:255',
            'numero_horas'=>'nullable|integer|min:0',
            'resolucion'=>'nullable|string|max:255',
            'fecha_resolucion'=>'nullable|date',
            'modalidad'=>'nullable|string|max:255',
            'vigencia'=>'nullable|string|max:255',
            'paralelos'=>'nullable|integer|min:0',
            'fecha_aprobacion'=>'nullable|date',
            'capacidad_x_paralelo'=>'nullable|integer|min:0',
            'foto'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
