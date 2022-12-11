<?php

namespace App\Http\Requests;

use App\Exceptions\ApiException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class BaseFormRequest extends FormRequest
{
    protected function failedValidation($validator)
    {
        throw (new ApiException($validator->errors()->first()))
            ->setHttpStatus(Response::HTTP_BAD_REQUEST);
    }

    protected $stopOnFirstFailure = true;
}