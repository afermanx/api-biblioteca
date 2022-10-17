<?php

namespace App\Http\Requests;

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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'institution_id' => ['sometimes', 'required', 'integer'],
            'name' => ['sometimes', 'required', 'string', 'unique:books,name'],
            'description' => ['sometimes', 'string', 'max:255'],
            'classification' => ['sometimes', 'required', 'string'],
            'author' => ['sometimes', 'required', 'string'],
            'publisher' => ['sometimes', 'required', 'string'],
            'status' => ['sometimes', 'boolean'],
            'avatar' => ['sometimes', 'image', 'mimes:png,jpg'],
            'amount' => ['sometimes', 'numeric'],
        ];
    }
}
