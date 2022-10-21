<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $authorized = User::where('id', Auth::user()->id)
        ->whereIn('type', ['librarian', 'super', 'main'])
        ->first();

        $authorized ? 'true' : false;
        return $authorized;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'library_id' => ['sometimes', 'required', 'integer'],
            'name' => ['sometimes', 'required', 'string', 'unique:books,name,' . $this->book->id],
            'description' => ['sometimes', 'string', 'max:255'],
            'classification' => ['sometimes', 'required', 'string'],
            'author' => ['sometimes', 'required', 'string'],
            'publisher' => ['sometimes', 'required', 'string'],
            'status' => ['sometimes', 'boolean'],
            'avatar' => ['sometimes', 'image', 'mimes:png,jpg'],
            'amount' => ['sometimes', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'library_id.required' => 'O campo biblioteca é obrigatório',
            'library_id.integer' => 'O campo biblioteca deve ser um inteiro',
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'name.unique' => 'O campo nome deve ser único',
            'description.string' => 'O campo descrição deve ser uma string',
            'description.max' => 'O campo descrição deve ter no máximo 255 caracteres',
            'classification.required' => 'O campo classificação é obrigatório',
            'classification.string' => 'O campo classificação deve ser uma string',
            'author.required' => 'O campo autor é obrigatório',
            'author.string' => 'O campo autor deve ser uma string',
            'publisher.required' => 'O campo editora é obrigatório',
            'publisher.string' => 'O campo editora deve ser uma string',
            'status.boolean' => 'O campo status deve ser um booleano',
            'avatar.image' => 'O campo avatar deve ser uma imagem',
            'avatar.mimes' => 'O campo avatar deve ser do tipo png ou jpg',
            'amount.numeric' => 'O campo quantidade deve ser um número',
        ];
    }
}
