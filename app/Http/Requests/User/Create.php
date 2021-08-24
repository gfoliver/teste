<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function rules()
    {
        return [
            'name'      => 'string|required',
            'email'     => 'string|required|email|unique:users',
            'password'  => 'string|required|min:8|confirmed',
            'cpf'       => 'string|required|cpf',
            'phone'     => 'string|required|celular_com_ddd'
        ];
    }
}
