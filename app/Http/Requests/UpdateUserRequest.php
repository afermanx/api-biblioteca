<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $is_Admin = Auth::user()->is_admin;
        return $is_Admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'institution_id' => ['sometimes', 'required'],
            'name' => ['sometimes', 'required'],
            'username' => ['sometimes', 'string', 'unique:users,username,'. $this->user->id ],
            'email' => ['sometimes','required', 'email:dns', 'unique:users,email,'. $this->user->id],
            'password' => ['sometimes','required, min:6, same:passwordConfirmation'],
            'type' => ['sometimes', 'required', 'string'],
            'is_admin' => ['sometimes','required, boolean'],
            'status' => ['sometimes','required, string']
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return void
     */
    public function messages()
    {
        return [
            'institution_id.required' => 'O campo instituição é obrigatório',
            'name.required' => 'O campo nome é obrigatório',
            'username.required' => 'O campo login é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'password.required' => 'O campo senha é obrigatório',
            'type.required' => 'O campo tipo é obrigatório',
            'is_admin.required' => 'O campo administrador é obrigatório',
            'status.required' => 'O campo status é obrigatório',
        ];
    }
}
