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
}
