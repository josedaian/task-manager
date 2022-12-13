<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class BadRequestException extends ApiException
{
    protected $message = "Invalid request format";
    protected $httpStatus = Response::HTTP_BAD_REQUEST;
}

