<?php

namespace App\Http\Requests\Cohorte;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizar extends FormRequest
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
            'id'=>'required|exists:cohortes,id',
            'numero'=>'required|integer|min:0',
            'sede'=>'required|string|max:255',
            'modalidad'=>'required|string|max:255',
            'paralelos'=>'required|integer|min:0|max:25',
            'valor_inscripcion'=>'required|regex:'.$rg_decimal,
            'valor_matricula'=>'required|regex:'.$rg_decimal,
            'valor_colegiatura'=>'required|regex:'.$rg_decimal,
            "coordinadores"    => "nullable|array",
            "coordinadores.*"  => "nullable|exists:users,id",
        ];
    }
}
