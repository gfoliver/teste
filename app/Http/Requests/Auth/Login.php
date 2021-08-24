<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $email
 * @property string $password
 */
class Login extends FormRequest
{
    public function rules()
    {
        return [
            'email'     => 'string|email|required',
            'password'  => 'string|required'
        ];
    }
}
