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
            'institution_id' => 'required_if:institution_id, institution_id',
            'name' => 'required_if:name, name',
            'cpf' => 'required_if:cpf, cpf|max:14',
            'email' => 'required_if:email, email|unique:users,email|email',
            'password' => 'required_if:password, password|min:6|same:passwordConfirmation',
            'is_admin' => 'boolean',
            'status' => 'string'
        ];
    }
}
