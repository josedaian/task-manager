<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class UnauthorizedException extends ApiException
{
    protected $message = "Invalid credentials";
    protected $httpStatus = Response::HTTP_UNAUTHORIZED;
}

