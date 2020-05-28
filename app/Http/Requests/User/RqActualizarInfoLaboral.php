<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RqActualizarInfoLaboral extends FormRequest
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
        $opcion='nullable';
        if($this->input('trabaja')=='SI'){
            $opcion='required';
        }

        return [
            'trabaja'=>'required|in:SI,NO',
            'tipo_institucion'=>'required|in:PÚBLICA,PRIVADA,MIXTA', 
            'empresa'=>$opcion.'|string|max:255', 
            'cargo'=>$opcion.'|string|max:255',
            'pais'=>$opcion.'|string|max:255', 
            'provincia'=>$opcion.'|string|max:255', 
            'canton'=>$opcion.'|string|max:255', 
            'telefono'=>'nullable|numeric|digits_between:1,15',
            'extencion'=>'nullable|string|max:255',
            'email'=>'nullable|email|max:255'
        ];
    }
}
