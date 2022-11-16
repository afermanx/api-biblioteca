<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ListRentRequest extends FormRequest
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
           'perPage' => 'integer|min:10|max:100',
           'user_id' => ['sometimes','required','integer', 'exists:users,id'],
           'user_name' => ['sometimes','required','string'],
           'book_id' => ['sometimes','required','integer', 'exists:books,id'],
           'book_name' => ['sometimes','required','string'],
           'due_date' => ['sometimes','required','date'],
           'rented_by' => ['sometimes','required','string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'Usuário é obrigatório',
            'user_id.exists' => 'Usuário não existe',
            'user_name.required' => 'Nome do usuário é obrigatório',
            'book_id.required' => 'Livro é obrigatório',
            'book_id.exists' => 'Livro não existe',
            'book_name.required' => 'Nome do livro é obrigatório',
            'due_date.required' => 'Data de devolução é obrigatório',
            'due_date.date' => 'Data de devolução deve ser uma data',
            'rented_by.required' => 'Usuário que alugou é obrigatório',
        ];
    }
}
