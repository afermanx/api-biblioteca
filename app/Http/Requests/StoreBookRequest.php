<?php

namespace App\Http\Requests;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
           'institution_id' => ['required', 'integer'],
           'name' => ['required', 'string', 'unique:books,name'],
           'description' => ['string', 'max:255'],
           'classification' => ['required', 'string'],
           'author' => ['required', 'string'],
           'publisher' => ['required', 'string'],
           'status' => ['boolean'],
           'avatar' => ['image', 'mimes:png,jpg'],
           'amount' => ['numeric'],
        ];
    }
}
