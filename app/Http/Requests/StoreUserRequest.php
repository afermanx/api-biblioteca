<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'institution_id' => 'required',
            'name' => 'required',
            'email' => ['required','unique:users,email', 'email:dns'],
            'password' => ['required','min:6', 'same:passwordConfirmation'],
            'type' => ['sometimes', 'required', 'string' ],
            'is_admin' => 'boolean',
            'status' => ['sometimes', 'required', 'string' ],
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return void
     */
     public function messages()
    {
        return[
            'username.required' => 'O campo nome de usuário é obrigatório.',
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.regex' => 'The email format is invalid.',
        ];
    } 
}
