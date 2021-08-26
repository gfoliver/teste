<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function rules()
    {
        return [
            'street'        => 'nullable|string',
            'number'        => 'nullable|integer',
            'neighborhood'  => 'nullable|string',
            'complement'    => 'nullable|string',
            'zip_code'      => 'nullable|string|formato_cep'
        ];
    }
}
