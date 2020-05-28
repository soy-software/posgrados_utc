<?php

namespace App\Http\Requests\Materia;

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
            'maestria'=>'required|exists:maestrias,id',
            'nombre'=>'required|string|max:255'
        ];
    }
}
