<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateInstitutionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $is_main = Auth::user()->type === 'main';
        return $is_main;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:6', 'unique:institutions,name'],
            'inep' => ['required', 'numeric', 'unique:institutions,inep']

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'name.min' => 'O campo nome deve ter no mínimo 6 caracteres',
            'name.unique' => 'O campo nome deve ser único',
            'inep.required' => 'O campo inep é obrigatório',
            'inep.numeric' => 'O campo inep deve ser um número',
            'inep.unique' => 'O campo inep deve ser único',
        ];
    }
}
