<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Update extends FormRequest
{
    public function rules()
    {
        return [
            'cpf'       => 'nullable|string|cpf',
            'name'      => 'nullable|string',
            'email'     => ['nullable', 'string', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],

            'phone'     => 'nullable|string|celular_com_ddd'
        ];
    }
}
