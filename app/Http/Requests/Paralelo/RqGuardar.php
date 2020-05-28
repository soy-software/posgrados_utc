<?php

namespace App\Http\Requests\Paralelo;

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
            'cohorte'=>'required|exists:cohortes,id',
            'nombre'=>'required|string|max:255',
            'fecha_inicio'=>'nullable|date',
            'fecha_fin'=>'nullable|date',
        ];
    }
}
