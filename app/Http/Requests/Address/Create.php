<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge(['user_id' => auth()->id()]);
    }

    public function rules()
    {
        return [
            'user_id'       => 'required|integer',
            'street'        => 'required|string',
            'number'        => 'required|integer',
            'neighborhood'  => 'required|string',
            'complement'    => 'nullable|string',
            'zip_code'      => 'required|string|formato_cep'
        ];
    }
}
