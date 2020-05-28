<?php

namespace App\Http\Requests\MallaCurricular;

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
        return [
            'id'=>'required|exists:malla_curriculars,id',
            'nivel'=>'nullable|string|max:255',
            'categoria'=>'nullable|string|max:255',
            'subindice'=>'nullable|integer|min:0',
            'materia'=>'required|exists:materias,id',
            'docente'=>'required|exists:users,id',      
        ];
    }
}
