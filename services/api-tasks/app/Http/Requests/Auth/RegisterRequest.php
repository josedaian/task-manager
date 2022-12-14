<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
            'name' => 'required'
        ];
    }
}
