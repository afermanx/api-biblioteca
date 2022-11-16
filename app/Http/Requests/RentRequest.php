<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->type !== 'student';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'days' => 'required|integer|min:1|max:30',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * @return array
     */
    public function messages()
    {
        return [
            'book_id.required' => 'Livro é obrigatório',
            'book_id.exists' => 'Livro não existe',
            'user_id.required' => 'Usuário é obrigatório',
            'user_id.exists' => 'Usuário não existe',
            'days.required' => 'Dias é obrigatório',
            'days.integer' => 'Dias deve ser um número inteiro',
            'days.min' => 'Dias deve ser maior que 0',
            'days.max' => 'Dias deve ser menor que 31',
        ];
    }
}
