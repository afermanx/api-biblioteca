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
            'institution_id' => 'sometimes|required',
            'name' => 'sometimes|required',
            'cpf' => 'sometimes|required|max:14',
            'email' => 'sometimes|required|unique:users,email|email',
            'password' => 'sometimes|required|min:6|same:passwordConfirmation',
            'is_admin' => 'sometimes|required|boolean',
            'status' => 'sometimes|required|string'
        ];
    }
}
