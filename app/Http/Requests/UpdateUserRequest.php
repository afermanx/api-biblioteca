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
            'email' => ['sometimes','required', 'unique:users,email,'. $this->user->id],
            'password' => ['sometimes','required, min:6, same:passwordConfirmation'],
            'type' => ['sometimes', 'required', 'string'],
            'is_admin' => ['sometimes','required, boolean'],
            'status' => ['sometimes','required, string']
        ];
    }
}
