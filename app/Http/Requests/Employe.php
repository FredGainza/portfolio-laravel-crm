<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Employe extends FormRequest
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
            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'entreprise_id' => ['required'],
            'email' => ['email'],
            'tel' => ['string'],
        ];
    }
}
