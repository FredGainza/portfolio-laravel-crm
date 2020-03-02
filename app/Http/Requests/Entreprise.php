<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Entreprise extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()){
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['email'],
            'logo' => ['image', 'dimensions:min_width=150,min_height=150'],
            'site' => ['string']
        ];
    }
}
